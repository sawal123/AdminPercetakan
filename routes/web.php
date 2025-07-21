<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TagihanController;

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
    Route::get('/pelanggan', [AdminController::class, 'pelanggan'])->name('pelanggan');
    Route::get('/pegawai', [AdminController::class, 'pegawai'])->name('pegawai');

    Route::get('/tagihan', [TagihanController::class, 'tagihan'])->name('tagihan');
    Route::get('/tagihan/create', [TagihanController::class, 'tagihanCreate'])->name('tagihan');
    Route::get('/tagihan/view/{invoice}', [TagihanController::class, 'tagihanView'])->name('view-tagihan');
    Route::get('/tagihan/edit/{invoice}', [TagihanController::class, 'tagihanEdit'])->name('view-tagihan');

    Route::get('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login'); // Arahkan ke halaman login setelah logout
    })->name('logout');
});
Route::middleware(['permission:admin'])->group(function () {
    Route::get('/kasir/penjualan', function () {
        return view('kasir.penjualan');
    });
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
