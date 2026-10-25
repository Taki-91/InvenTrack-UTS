<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $sales = Sale::with('user')
            ->when($request->search, function ($query, $search) {
                $query->where('sale_number', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::where('is_active', true)
            ->where('stock', '>', 0)
            ->orderBy('name')
            ->get();

        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sale_date' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'product_ids' => ['required', 'array', 'min:1'],
            'product_ids.*' => [
                'required', 'integer', 'distinct', 'exists:products,id'
            ],
            'quantities' => ['required', 'array', 'min:1'],
            'quantities.*' => ['required', 'integer', 'min:1'],
        ]);

        if (count($validated['product_ids']) !== count($validated['quantities'])) {
            throw ValidationException::withMessages([
                'product_ids' => 'Jumlah produk dan kuantitas tidak sesuai.',
            ]);
        }

        $sale = DB::transaction(function () use ($validated) {
            $sale = Sale::create([
                'sale_number' => 'SAL-' . now()->format('YmdHis')
                    . '-' . strtoupper(\Illuminate\Support\Str::random(4)),
                'user_id' => auth()->id(),
                'sale_date' => $validated['sale_date'],
                'total_amount' => 0,
                'status' => 'completed',
                'notes' => $validated['notes'] ?? null,
            ]);

            $total = 0;

            foreach ($validated['product_ids'] as $index => $productId) {
                $product = Product::whereKey($productId)
                    ->lockForUpdate()
                    ->firstOrFail();

                $quantity = (int) $validated['quantities'][$index];

                if (!$product->is_active) {
                    throw ValidationException::withMessages([
                        'product_ids' => "Produk {$product->name} tidak aktif.",
                    ]);
                }

                if ($product->stock < $quantity) {
                    throw ValidationException::withMessages([
                        'quantities' => "Stok {$product->name} tidak cukup. Stok tersedia: {$product->stock}.",
                    ]);
                }

                $price = (float) $product->selling_price;
                $subtotal = round($price * $quantity, 2);

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $price,
                    'subtotal' => $subtotal,
                ]);

                $product->decrement('stock', $quantity);

                $total += $subtotal;
            }

            $sale->update(['total_amount' => $total]);

            return $sale;
        });

        return redirect()->route('sales.show', $sale)
            ->with('success', 'Penjualan berhasil disimpan dan stok telah diperbarui.');
    }

    public function show(Sale $sale)
    {
        $sale->load(['user', 'items.product']);

        return view('sales.show', compact('sale'));
    }
}
