<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $role = strtolower($user->role ?? 'user');
        $isOwner = $role === 'owner';
        $isAdmin = $role === 'admin';
        $isStaff = $isAdmin || $isOwner;
        $isUser = $role === 'user';

        // Statistik inventaris
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();
        $totalStock = Product::sum('stock');

        $lowStockProducts = Product::with('category')
            ->whereColumn('stock', '<=', 'minimum_stock')
            ->orderBy('stock')
            ->take(5)
            ->get();

        $lowStock = Product::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )->count();

        // Statistik penjualan hanya menghitung transaksi selesai.
        $salesQuery = Sale::where('status', 'completed');

        if ($isUser) {
            $salesQuery->where('user_id', $user->id);
        }

        $totalSales = (clone $salesQuery)->sum('total_amount');
        $totalTransactions = (clone $salesQuery)->count();

        // Statistik pembelian hanya untuk Owner dan Admin.
        $totalPurchases = 0;

        if ($isStaff) {
            $totalPurchases = Purchase::where('status', 'completed')
                ->sum('total_amount');
        }

        // Transaksi terbaru. User hanya melihat transaksi miliknya.
        $recentSalesQuery = Sale::with('user');

        if ($isUser) {
            $recentSalesQuery->where('user_id', $user->id);
        }

        $recentSales = $recentSalesQuery
            ->latest()
            ->take(5)
            ->get();

        // Produk terbaru.
        $latestProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        // Grafik penjualan tujuh hari terakhir.
        $chartLabels = [];
        $chartSales = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);

            $chartLabels[] = $date->translatedFormat('d M');

            $dailySales = Sale::where('status', 'completed')
                ->whereDate('sale_date', $date->toDateString());

            if ($isUser) {
                $dailySales->where('user_id', $user->id);
            }

            $chartSales[] = (float) $dailySales->sum('total_amount');
        }

        return view('dashboard', compact(
            'isOwner',
            'isAdmin',
            'isStaff',
            'isUser',
            'totalProducts',
            'totalCategories',
            'totalSuppliers',
            'totalStock',
            'lowStock',
            'lowStockProducts',
            'totalSales',
            'totalTransactions',
            'totalPurchases',
            'recentSales',
            'latestProducts',
            'chartLabels',
            'chartSales'
        ));
    }
}
