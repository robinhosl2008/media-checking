<?php

namespace App\Http\Controllers\TipoMidia;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoMidia\RemoverTipoMidiaRequest;
use App\Http\Requests\TipoMidia\SalvarTipoMidiaRequest;
use App\Http\Requests\TipoMidia\EditarTipoMidiaRequest;
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
            'id'        => ($request->id) ?? '',
            'descricao' => ($request->descricao) ?? ''
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

    public function criar(): View
    {
        $tipoMidia = null;

        return view('midia-checking.cadastro.tipos-midia.criar', [
            'tipoMidia' => $tipoMidia
        ]);
    }

    public function editar(Request $request): View
    {
        $tipoMidia = null;
        if ($request->id) {
            $tipoMidia = $this->buscar($request)->first();
        }

        return view('midia-checking.cadastro.tipos-midia.editar', [
            'tipoMidia' => $tipoMidia
        ]);
    }

    public function salvarCriacao(SalvarTipoMidiaRequest $request)
    {
        $validated = $request->validated();

        dd($validated);
    }

    public function salvarEdicao(EditarTipoMidiaRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        return redirect()->route('listar-tipo-midia');
    }

    public function removerTipoMidia(RemoverTipoMidiaRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        return redirect()->route('listar-tipo-midia');
    }
}