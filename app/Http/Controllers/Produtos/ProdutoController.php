<?php

namespace App\Http\Controllers\Produtos;

use App\Http\Controllers\Controller;
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
            'vertical_id'   => ($request->vertical_id) ?? '',
            'tipo_midia_id' => ($request->tipo_midia_id) ?? '',
            'descricao'     => ($request->descricao) ?? ''
        ];
        
        return $this->proc->buscaProdutos($params)->get();
    }

    public function show(Request $request): View
    {
        $produtos = $this->buscar($request);
        
        return view('midia-checking.cadastro.produtos.index', [
            'produtos' => $produtos
        ]);
    }

    public function new(Request $request): View
    {
        return view('midia-checking.cadastro.produtos.form');
    }
}
