<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Supplier;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $role = strtolower($user->role ?? 'user');

        $isOwner = $role === 'owner';
        $isAdmin = $role === 'admin';
        $isUser = $role === 'user';
        $isStaff = $isOwner || $isAdmin;

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

        // Penjualan selesai, sesuai akses masing-masing role
        $salesQuery = Sale::where('status', 'completed');

        if ($isUser) {
            $salesQuery->where('user_id', $user->id);
        }

        $totalSales = (clone $salesQuery)->sum('total_amount');
        $totalTransactions = (clone $salesQuery)->count();

        // Transaksi hari ini
        $todayQuery = Sale::where('status', 'completed')
            ->whereDate('sale_date', Carbon::today());

        if ($isUser) {
            $todayQuery->where('user_id', $user->id);
        }

        $todayTransactions = (clone $todayQuery)->count();
        $todaySales = (clone $todayQuery)->sum('total_amount');

        // Pembelian hanya untuk Owner dan Admin
        $totalPurchases = 0;

        if ($isStaff) {
            $totalPurchases = Purchase::where('status', 'completed')
                ->sum('total_amount');
        }

        // Transaksi terbaru
        $recentSalesQuery = Sale::with('user');

        if ($isUser) {
            $recentSalesQuery->where('user_id', $user->id);
        }

        $recentSales = $recentSalesQuery
            ->latest()
            ->take(5)
            ->get();

        // Produk terbaru
        $latestProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        // Grafik penjualan tujuh hari terakhir
        $chartLabels = [];
        $chartSales = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);

            $chartLabels[] = $date->translatedFormat('d M');

            $dailyQuery = Sale::where('status', 'completed')
                ->whereDate('sale_date', $date->toDateString());

            if ($isUser) {
                $dailyQuery->where('user_id', $user->id);
            }

            $chartSales[] = (float) $dailyQuery->sum('total_amount');
        }

        // Produk terlaris berdasarkan jumlah barang terjual
        $bestSellingProducts = Product::query()
            ->select('products.id', 'products.name', 'products.sku')
            ->join(
                'sale_items',
                'products.id',
                '=',
                'sale_items.product_id'
            )
            ->join(
                'sales',
                'sale_items.sale_id',
                '=',
                'sales.id'
            )
            ->where('sales.status', 'completed')
            ->selectRaw('SUM(sale_items.quantity) as total_quantity')
            ->selectRaw('SUM(sale_items.subtotal) as total_revenue')
            ->groupBy('products.id', 'products.name', 'products.sku')
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get();

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
            'todayTransactions',
            'todaySales',
            'recentSales',
            'latestProducts',
            'chartLabels',
            'chartSales',
            'bestSellingProducts'
        ));
    }
}
