<?php

namespace App\Http\Controllers\Produtos;

use App\Http\Requests\Produto\EditarProdutoRequest;
use App\Http\Requests\Produto\SalvarProdutoRequest;
use App\Http\Requests\Produto\RemoverProdutoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\Proc;

class ProdutoController extends Controller
{
    private Proc $proc;

    public function __construct()
    {
        $this->proc = new Proc();
    }

    public function buscar(Request $request)
    {
        $params = [
            'id'            => ($request->id) ?? '',
            'vertical_id'   => ($request->vertical_id) ?? '',
            'tipo_midia_id' => ($request->tipo_midia_id) ?? '',
            'descricao'     => ($request->descricao) ?? ''
        ];
        
        return $this->proc->buscaProdutos($params)->get();
    }

    public function listar(Request $request): View
    {
        $produtos = $this->buscar($request);
        
        return view('midia-checking.cadastro.produtos.index', [
            'produtos' => $produtos
        ]);
    }

    public function criar(): View
    {
        $verticais = $this->proc->buscaVerticais()->get();
        
        return view('midia-checking.cadastro.produtos.criar', [
            'verticais' => $verticais
        ]);
    }

    public function editar(Request $request): View
    {
        $produto = $this->buscar($request)->first();
        $verticais = $this->proc->buscaVerticais()->get();
        
        return view('midia-checking.cadastro.produtos.editar', [
            'produto' => $produto,
            'verticais' => $verticais
        ]);
    }

    public function salvarCriacao(SalvarProdutoRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // dd($validated);
        return redirect('/cadastro/produtos')->with('msg', 'Produto cadastrado.');
    }

    public function salvarEdicao(EditarProdutoRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // dd($validated);
        return redirect('/cadastro/produtos')->with('msg', 'Produto atualizado.');
    }

    public function removerProduto(RemoverProdutoRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // dd($validated);
        return redirect('/cadastro/produtos')->with('msg', 'Produto removido.');
    }
}
