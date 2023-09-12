<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MidiaController;
use App\Http\Controllers\Produtos\ProdutoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Verticais\VerticalController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/validar', [MidiaController::class, 'index'])->name('media-checking.validar');

    Route::post('/buscar-verticais', [VerticalController::class, 'index'])->name('verticais.index');
    Route::post('/buscar-produtos', [ProdutoController::class, 'index'])->name('produto.index');
});

require __DIR__.'/auth.php';
