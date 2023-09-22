<?php

namespace App\Http\Controllers\Produtos;

use App\Http\Controllers\Controller;
use App\Services\{
    ProcProduto,
    ProcVertical
};
use App\Http\Requests\Produto\{
    EditarProdutoRequest,
    SalvarProdutoRequest,
    RemoverProdutoRequest
};
use Illuminate\Http\{
    RedirectResponse,
    Request
};
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Exception;

class ProdutoController extends Controller
{
    private ProcProduto $proc;
    private ProcVertical $procVertical;

    public function __construct()
    {
        $this->proc = new ProcProduto();
        $this->procVertical = new ProcVertical();
    }

    public function buscar(Request $request)
    {
        $params = [
            'id'            => ($request->id) ?? '',
            'vertical_id'   => ($request->vertical_id) ?? '',
            'tipo_midia_id' => ($request->tipo_midia_id) ?? '',
            'descricao'     => ($request->descricao) ?? ''
        ];
        
        return $this->proc->buscar($params)->get();
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
        $verticais = $this->procVertical->buscar([])->get();
        
        return view('midia-checking.cadastro.produtos.criar', [
            'verticais' => $verticais
        ]);
    }

    public function editar(Request $request): View
    {
        $produto = $this->buscar($request)->first();
        $verticais = $this->procVertical->buscar()->get();
        
        return view('midia-checking.cadastro.produtos.editar', [
            'produto' => $produto,
            'verticais' => $verticais
        ]);
    }

    public function salvarCriacao(SalvarProdutoRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $this->proc->salvarProduto($validated);

            DB::commit();

            return redirect('/cadastro/produtos')
                ->with('typeMessage', 'success')
                ->with('msg', 'Produto cadastrado.');
        } catch(Exception $e) {
            DB::rollBack();

            return redirect('/cadastro/produtos')
                ->with('typeMessage', 'warning')
                ->with('msg', 'Um erro ocorreu ao tentar salvar o produto. ' . $e->getMessage());
        }
    }

    public function salvarEdicao(EditarProdutoRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $this->proc->editaProduto($validated);

            DB::commit();

            return redirect('/cadastro/produtos')
                ->with('typeMessage', 'success')
                ->with('msg', 'Produto editado.');
        } catch(Exception $e) {
            DB::rollBack();

            return redirect('/cadastro/produtos')
                ->with('typeMessage', 'warning')
                ->with('msg', 'Um erro ocorreu ao tentar editar o produto. ' . $e->getMessage());
        }
    }

    public function removerProduto(RemoverProdutoRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $this->proc->removeProduto($validated);

            DB::commit();

            return redirect('/cadastro/produtos')
                ->with('typeMessage', 'success')
                ->with('msg', 'Produto excluido.');
        } catch(Exception $e) {
            DB::rollBack();

            return redirect('/cadastro/produtos')
                ->with('typeMessage', 'warning')
                ->with('msg', 'Um erro ocorreu ao tentar excluir o produto. ' . $e->getMessage());
        }
    }
}
