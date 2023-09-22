<?php

namespace App\Http\Controllers\Verticais;

use App\Http\Requests\Vertical\SalvarVerticalRequest;
use App\Http\Requests\Vertical\EditarVerticalRequest;
use App\Http\Requests\Vertical\RemoverVerticalRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\Proc;

class VerticalController extends Controller
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
            'tipo_midia_id' => ($request->tipo_midia_id) ?? '',
            'descricao'     => ($request->descricao) ?? ''
        ];
        
        return $this->proc->buscaVerticais($params)->get();
    }

    public function listar(Request $request): View
    {
        $verticais = $this->buscar($request);

        return view('midia-checking.cadastro.verticais.index', [
            'verticais' => $verticais
        ]);
    }

    public function criar(): View
    {
        $tiposMidia = $this->proc->buscaTiposMidia()->get();

        return view('midia-checking.cadastro.verticais.criar', [
            'tiposMidia' => $tiposMidia,
            'vertical' => null
        ]);
    }

    public function editar(Request $request): View
    {
        $vertical = null;
        if ($request->id) {
            $vertical = $this->buscar($request)->first();
        }

        $tiposMidia = $this->proc->buscaTiposMidia([])->get();

        return view('midia-checking.cadastro.verticais.editar', [
            'tiposMidia' => $tiposMidia,
            'vertical' => $vertical
        ]);
    }

    public function salvarCriacao(SalvarVerticalRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // dd($validated);
        return redirect('/cadastro/verticais')->with('msg', 'Vertical cadastrada.');
    }

    public function salvarEdicao(EditarVerticalRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // dd($validated);
        return redirect('/cadastro/verticais')->with('msg', 'Vertical editada.');
    }

    public function removerVertical(RemoverVerticalRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // dd($validated);
        return redirect('/cadastro/verticais')->with('msg', 'Vertical removida.');
    }
}
