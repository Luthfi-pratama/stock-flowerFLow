<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('guest.home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        // Admin dashboard
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Admin profile routes
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
        // Admin product routes
        Route::prefix('produk')
            ->name('produk.')
            ->controller(ProdukController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/edit/{produk}', 'edit')->name('edit');
                Route::patch('/{id}', 'update')->name('update');
                Route::delete('/{produk}', 'destroy')->name('destroy');
            });
    });

// Guest routes
Route::prefix('guest')
    ->name('guest.')
    ->controller(GuestController::class)
    ->group(function () {
        Route::get('/', 'home')->name('home');
        Route::post('/', 'catalog')->name('catalog');

        Route::get('/shop', 'shop')->name('shop');
        Route::get('/about-us', 'about')->name('about');
    });

Route::prefix('user')
    ->name('user.')
    ->middleware(['auth','verified'])
    ->group(function () {
        Route::prefix('cart')
            ->name('cart.')
            ->controller(CartController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'add')->name('add');
                Route::delete('/remove/{cartId}', 'remove')->name('remove');
                Route::patch('/update', 'update')->name('update');
            });
        Route::prefix('transaction')
            ->name('transaction.')
            ->controller(TransactionController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/placeOrder', 'placeOrder')->name('placeOrder');
            });
    });

require __DIR__.'/auth.php';