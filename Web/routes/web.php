<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

Route::middleware('loggedin')->group(function() {
    Route::get('login', [AuthController::class, 'loginView'])->name('login.index');
    Route::post('login', [AuthController::class, 'login'])->name('login.check');
    Route::get('register', [AuthController::class, 'registerView'])->name('register.index');
    Route::post('register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [CartController::class, 'index'])->name('cart-index');
    Route::get('/create', [DashboardController::class, 'create'])->name('dashboard-create');
    Route::post('/create', [DashboardController::class, 'store'])->name('dashboard-store');
    Route::get('/edit/{id}', [DashboardController::class, 'edit'])->name('dashboard-edit');
    Route::put('/update/{id}', [DashboardController::class, 'update'])->name('dashboard-update');
    Route::delete('/destroy/{id}', [DashboardController::class, 'destroy'])->name('dashboard-destroy');
    
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori-index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori-create');
    Route::post('/kategori/create', [KategoriController::class, 'store'])->name('kategori-store');
    Route::get('/kategori/{id}', [KategoriController::class, 'edit'])->name('kategori-edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori-update');    
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori-destroy');

    Route::get('/produk', [ProdukController::class, 'index'])->name('produk-index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk-create');
    Route::post('/produk/create', [ProdukController::class, 'store'])->name('produk-store');
    Route::get('/produk/{id}', [ProdukController::class, 'edit'])->name('produk-edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk-update');    
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk-destroy');

    Route::get('/cart', [CartController::class, 'index'])->name('cart-index');
    Route::get('/cart/create', [CartController::class, 'create'])->name('cart-create');
    Route::post('/cart/create', [CartController::class, 'store'])->name('cart-store');
    Route::get('/cart/{id}', [CartController::class, 'edit'])->name('cart-edit');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart-update');    
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart-destroy');
});
