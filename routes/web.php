<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Semua halaman yang memerlukan login
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // KATEGORI
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    Route::middleware('role:Admin')->group(function () {
        Route::get('/categories/create', [CategoryController::class, 'create'])
            ->name('categories.create');

        Route::post('/categories', [CategoryController::class, 'store'])
            ->name('categories.store');

        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
            ->name('categories.edit');

        Route::put('/categories/{category}', [CategoryController::class, 'update'])
            ->name('categories.update');

        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
            ->name('categories.destroy');
    });

    // PRODUK
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    Route::middleware('role:Admin')->group(function () {
        Route::get('/products/create', [ProductController::class, 'create'])
            ->name('products.create');

        Route::post('/products', [ProductController::class, 'store'])
            ->name('products.store');

        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
            ->name('products.edit');

        Route::put('/products/{product}', [ProductController::class, 'update'])
            ->name('products.update');

        Route::delete('/products/{product}', [ProductController::class, 'destroy'])
            ->name('products.destroy');
    });

    // SUPPLIER
    Route::get('/suppliers', [SupplierController::class, 'index'])
        ->name('suppliers.index');

    Route::middleware('role:Admin')->group(function () {
        Route::get('/suppliers/create', [SupplierController::class, 'create'])
            ->name('suppliers.create');

        Route::post('/suppliers', [SupplierController::class, 'store'])
            ->name('suppliers.store');

        Route::get('/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])
            ->name('suppliers.edit');

        Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])
            ->name('suppliers.update');

        Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])
            ->name('suppliers.destroy');
    });

    // PEMBELIAN / STOK MASUK
    Route::get('/purchases', [PurchaseController::class, 'index'])
        ->name('purchases.index');

    // Admin dan Staff boleh membuat pembelian / stock-in
    Route::middleware('role:Admin,Staff')->group(function () {
        Route::get('/purchases/create', [PurchaseController::class, 'create'])
            ->name('purchases.create');

        Route::post('/purchases', [PurchaseController::class, 'store'])
            ->name('purchases.store');
    });

    Route::get('/purchases/{purchase}', [PurchaseController::class, 'show'])
        ->name('purchases.show');

    // PENJUALAN
    Route::get('/sales', [SaleController::class, 'index'])
        ->name('sales.index');

    // Admin dan Staff boleh membuat penjualan
    Route::middleware('role:Admin,Staff')->group(function () {
        Route::get('/sales/create', [SaleController::class, 'create'])
            ->name('sales.create');

        Route::post('/sales', [SaleController::class, 'store'])
            ->name('sales.store');
    });

    Route::get('/sales/{sale}', [SaleController::class, 'show'])
        ->name('sales.show');
});

// Route login, logout, dan autentikasi lainnya
require __DIR__.'/auth.php';
