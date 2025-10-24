<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DemoController;

/* Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home'); */

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
    Route::get('/', [DemoController::class, 'index'])->name('home');
    Route::get('/post/{id}', [DemoController::class, 'showPost'])->name('post.show');

    // Products
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('products/report', [ProductController::class,'generateReport'])->name('products.report');
    Route::get('products/report/{id}', [ProductController::class,'generateReport'])->name('products.report');

    Route::get('products/export/', [ProductController::class, 'export'])->name('products.export');

});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
