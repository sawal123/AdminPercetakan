<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard'); 
    Route::get('/barang', [AdminController::class, 'barang'])->name('barang'); 
    Route::get('/tagihan', [AdminController::class, 'tagihan'])->name('tagihan'); 
    Route::get('/pelanggan', [AdminController::class, 'pelanggan'])->name('pelanggan'); 
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
