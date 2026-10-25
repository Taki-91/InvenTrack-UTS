<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();

        $totalStock = Product::sum('stock');

        $lowStockProducts = Product::with('category')
            ->whereColumn('stock', '<=', 'minimum_stock')
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        $lowStock = Product::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )->count();

        $totalSales = Sale::where('status', 'completed')
            ->sum('grand_total');

        $totalPurchases = Purchase::where('status', 'completed')
            ->sum('total_amount');

        $recentSales = Sale::with('user')
            ->latest()
            ->take(5)
            ->get();

        $latestProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalSuppliers',
            'totalStock',
            'lowStock',
            'lowStockProducts',
            'totalSales',
            'totalPurchases',
            'recentSales',
            'latestProducts'
        ));
    }
}
