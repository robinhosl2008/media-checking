<?php

namespace App\Http\Controllers\TipoMidia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\Proc;

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
            'tipo_midia_id'   => ($request->tipo_midia_id) ?? '',
            'descricao'     => ($request->descricao) ?? ''
        ];
        
        return $this->proc->buscaTiposMidia($params)->get();
    }

    public function show(Request $request): View
    {
        $tiposMidia = $this->buscar($request);

        return view('midia-checking.cadastro.tipos-midia.index', [
            'tiposMidia' => $tiposMidia
        ]);
    }

    public function new(): View
    {
        return view('midia-checking.cadastro.tipos-midia.form');
    }
}