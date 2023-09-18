<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MidiaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Produtos\ProdutoController;
use App\Http\Controllers\TipoMidia\TipoMidiaController;
use App\Http\Controllers\Usuarios\UsuarioController;
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

    Route::get('/validar', [MidiaController::class, 'index'])->name('midia-checking.validar');

    Route::post('/buscar-verticais', [VerticalController::class, 'buscar'])->name('verticais.buscar');
    Route::post('/buscar-produtos', [ProdutoController::class, 'buscar'])->name('produto.buscar');
    Route::post('/buscar-resolucao', [MidiaController::class, 'buscarResolucao'])->name('buscar-resolucao');

    // Cadastro/Usuários
    Route::get('/cadastro/usuario', [UsuarioController::class, 'index'])->name('lista-usuario');
    Route::get('/cadastro/usuario/cadastra', [UsuarioController::class, 'store'])->name('cadastra-usuario');
    Route::get('/cadastro/usuario/{id}/edita', [UsuarioController::class, 'update'])->name('edita-usuario');
    Route::get('/cadastro/usuario/{id}/remove', [UsuarioController::class, 'destroy'])->name('remove-usuario');

    // Cadastro/Tipos de Mídia
    Route::get('/cadastro/tipo-midia', [TipoMidiaController::class, 'index'])->name('lista-tipo-midia');
    Route::get('/cadastro/tipo-midia/cadastra', [TipoMidiaController::class, 'store'])->name('cadastra-tipo-midia');
    Route::get('/cadastro/tipo-midia/{id}/edita', [TipoMidiaController::class, 'update'])->name('edita-tipo-midia');
    Route::get('/cadastro/tipo-midia/{id}/remove', [TipoMidiaController::class, 'destroy'])->name('remove-tipo-midia');

    // Cadastro/Verticais
    Route::get('/cadastro/verticais', [VerticalController::class, 'index'])->name('lista-verticais');
    Route::get('/cadastro/verticais/cadastra', [VerticalController::class, 'store'])->name('cadastra-verticais');
    Route::get('/cadastro/verticais/{id}/edita', [VerticalController::class, 'update'])->name('edita-verticais');
    Route::get('/cadastro/verticais/{id}/remove', [VerticalController::class, 'destroy'])->name('remove-verticais');

    // Cadastro/Produtos
    Route::get('/cadastro/produtos', [ProdutoController::class, 'index'])->name('lista-produtos');
    Route::get('/cadastro/produtos/cadastra', [VerticalController::class, 'store'])->name('cadastra-produtos');
    Route::get('/cadastro/produtos/{id}/edita', [VerticalController::class, 'update'])->name('edita-produtos');
    Route::get('/cadastro/produtos/{id}/remove', [VerticalController::class, 'destroy'])->name('remove-produtos');
});

require __DIR__.'/auth.php';
