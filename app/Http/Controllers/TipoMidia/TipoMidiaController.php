<?php

namespace App\Http\Controllers\TipoMidia;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTipoMidiaRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\Proc;
use Illuminate\Http\RedirectResponse;

class TipoMidiaController extends Controller
{
    private Proc $proc;

    public function __construct()
    {
        $this->proc = new Proc();
    }

    public function buscar(Request $request)
    {
        $params = [
            'id'   => ($request->tipo_midia_id) ?? '',
            'descricao'     => ($request->descricao) ?? ''
        ];
        
        return $this->proc->buscaTiposMidia($params)->get();
    }

    public function listar(Request $request): View
    {
        $tiposMidia = $this->buscar($request);

        return view('midia-checking.cadastro.tipos-midia.index', [
            'tiposMidia' => $tiposMidia
        ]);
    }

    public function form(Request $request): View
    {
        $tipoMidia = null;
        if ($request->id) {
            $tipoMidia = $this->buscar($request)->first();
        }

        return view('midia-checking.cadastro.tipos-midia.form', [
            'tipoMidia' => $tipoMidia
        ]);
    }

    public function salvar(StoreTipoMidiaRequest $request)
    {
        $validated = $request->validated();

        dd($validated);
    }

    public function editar(Request $request): RedirectResponse
    {
        return redirect()->route('listar-tipo-midia');
    }

    public function remover(Request $request): RedirectResponse
    {
        return redirect()->route('listar-tipo-midia');
    }
}