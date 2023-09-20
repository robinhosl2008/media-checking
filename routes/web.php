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

    Route::get('/validar', [MidiaController::class, 'validar'])->name('midia-checking.validar');
    Route::get('/converter', [MidiaController::class, 'converter'])->name('midia-checking.converter');

    Route::post('/buscar-verticais', [VerticalController::class, 'buscar'])->name('verticais.buscar');
    Route::post('/buscar-produtos', [ProdutoController::class, 'buscar'])->name('produto.buscar');
    Route::post('/buscar-resolucao', [MidiaController::class, 'buscarResolucao'])->name('buscar-resolucao');

    // Cadastro/Usuários
    Route::get('/cadastro/usuario', [UsuarioController::class, 'listar'])->name('listar-usuario');
    Route::get('/cadastro/usuario/criar', [UsuarioController::class, 'criar'])->name('criar-usuario');
    Route::get('/cadastro/usuario/{id}/editar', [UsuarioController::class, 'editar'])->name('editar-usuario');
    Route::post('/cadastro/usuario/salvar-criacao', [UsuarioController::class, 'salvarCriacao'])->name('salvar-criacao-usuario');
    Route::put('/cadastro/usuario/salvar-edicao', [UsuarioController::class, 'salvarEdicao'])->name('salvar-edicao-usuario');
    Route::delete('/cadastro/usuario/remover', [UsuarioController::class, 'remover'])->name('remover-usuario');

    // Cadastro/Tipos de Mídia
    Route::get('/cadastro/tipo-midia', [TipoMidiaController::class, 'listar'])->name('listar-tipo-midia');
    Route::get('/cadastro/tipo-midia/form', [TipoMidiaController::class, 'form'])->name('form-tipo-midia');
    Route::post('/cadastro/tipo-midia/salvar', [TipoMidiaController::class, 'salvar'])->name('salvar-tipo-midia');
    Route::get('/cadastro/tipo-midia/{id}/editar', [TipoMidiaController::class, 'update'])->name('editar-tipo-midia');
    Route::get('/cadastro/tipo-midia/{id}/remover', [TipoMidiaController::class, 'destroy'])->name('remover-tipo-midia');

    // Cadastro/Verticais
    Route::get('/cadastro/verticais', [VerticalController::class, 'listar'])->name('listar-verticais');
    Route::get('/cadastro/verticais/form', [VerticalController::class, 'form'])->name('form-verticais');
    Route::post('/cadastro/verticais/salvar', [VerticalController::class, 'salvar'])->name('salvar-verticais');
    Route::get('/cadastro/verticais/{id}/editar', [VerticalController::class, 'update'])->name('editar-verticais');
    Route::get('/cadastro/verticais/{id}/remover', [VerticalController::class, 'destroy'])->name('remover-verticais');

    // Cadastro/Produtos
    Route::get('/cadastro/produtos', [ProdutoController::class, 'listar'])->name('listar-produtos');
    Route::get('/cadastro/produtos/form', [ProdutoController::class, 'form'])->name('form-produtos');
    Route::post('/cadastro/produtos/salvar', [ProdutoController::class, 'salvar'])->name('salvar-produtos');
    Route::get('/cadastro/produtos/{id}/editar', [ProdutoController::class, 'update'])->name('editar-produtos');
    Route::get('/cadastro/produtos/{id}/remover', [ProdutoController::class, 'destroy'])->name('remover-produtos');
});

require __DIR__.'/auth.php';
