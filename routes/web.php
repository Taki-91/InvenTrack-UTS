<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // PROFIL
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // KATEGORI: semua role boleh melihat
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    // OWNER DAN ADMIN/STAF boleh mengelola kategori
    Route::middleware('role:Owner,Admin')->group(function () {
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

    // PRODUK: semua role boleh melihat
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    // HANYA OWNER boleh mengelola produk
    Route::middleware('role:Owner')->group(function () {
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

    // SUPPLIER: semua role boleh melihat
    Route::get('/suppliers', [SupplierController::class, 'index'])
        ->name('suppliers.index');

    // HANYA OWNER boleh mengelola supplier
    Route::middleware('role:Owner')->group(function () {
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

    // STOK MASUK: Owner dan Admin/Staf
    Route::middleware('role:Owner,Admin')->group(function () {
        Route::get('/purchases', [PurchaseController::class, 'index'])
            ->name('purchases.index');

        Route::get('/purchases/create', [PurchaseController::class, 'create'])
            ->name('purchases.create');

        Route::post('/purchases', [PurchaseController::class, 'store'])
            ->name('purchases.store');

        Route::get('/purchases/{purchase}', [PurchaseController::class, 'show'])
            ->name('purchases.show');
    });

    // PENJUALAN: Owner, Admin/Staf, dan User
    Route::middleware('role:Owner,Admin,User')->group(function () {
        Route::get('/sales', [SaleController::class, 'index'])
            ->name('sales.index');

        Route::get('/sales/create', [SaleController::class, 'create'])
            ->name('sales.create');

        Route::post('/sales', [SaleController::class, 'store'])
            ->name('sales.store');

        Route::get('/sales/{sale}', [SaleController::class, 'show'])
            ->name('sales.show');
    });

    // PEMBATALAN TRANSAKSI: HANYA OWNER
    Route::patch('/sales/{sale}/cancel', [SaleController::class, 'cancel'])
        ->middleware('role:Owner')
        ->name('sales.cancel');
});

// Autentikasi
require __DIR__.'/auth.php';
