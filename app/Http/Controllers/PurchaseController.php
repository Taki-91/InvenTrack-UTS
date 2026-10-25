<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'user'])
            ->latest()
            ->paginate(10);

        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = \App\Models\Supplier::orderBy('name')->get();

        $products = Product::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('purchases.create', compact('suppliers', 'products'));
    }

    public function store(StorePurchaseRequest $request)
    {
        $validated = $request->validated();

        $purchase = DB::transaction(function () use ($validated) {
            $purchaseNumber = 'PUR-' . now()->format('YmdHis') . '-' . strtoupper(\Illuminate\Support\Str::random(4));

            $totalAmount = 0;

            foreach ($validated['product_ids'] as $index => $productId) {
                $quantity = (int) $validated['quantities'][$index];
                $unitCost = (float) $validated['unit_costs'][$index];

                $totalAmount += $quantity * $unitCost;
            }

            $purchase = Purchase::create([
                'purchase_number' => $purchaseNumber,
                'supplier_id' => $validated['supplier_id'],
                'user_id' => auth()->id(),
                'purchase_date' => $validated['purchase_date'],
                'total_amount' => $totalAmount,
                'status' => 'completed',
                'notes' => $validated['notes'] ?? null,
            ]);

            foreach ($validated['product_ids'] as $index => $productId) {
                $quantity = (int) $validated['quantities'][$index];
                $unitCost = (float) $validated['unit_costs'][$index];
                $subtotal = $quantity * $unitCost;

                $product = Product::whereKey($productId)
                    ->lockForUpdate()
                    ->firstOrFail();

                $purchase->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_cost' => $unitCost,
                    'subtotal' => $subtotal,
                ]);

                $product->increment('stock', $quantity);

                $product->update([
                    'purchase_price' => $unitCost,
                ]);
            }

            return $purchase;
        });

        return redirect()
            ->route('purchases.index')
            ->with('success', 'Transaksi stok masuk berhasil disimpan.');
    }

    public function show(Purchase $purchase)
    {
        $purchase->load(['supplier', 'user', 'items.product']);

        return view('purchases.show', compact('purchase'));
    }
}
