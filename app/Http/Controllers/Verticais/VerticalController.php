<?php

namespace App\Http\Controllers\Verticais;

use App\Http\Controllers\Controller;
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
            'vertical_id'   => ($request->vertical_id) ?? '',
            'tipo_midia_id' => ($request->tipo_midia_id) ?? '',
            'descricao'     => ($request->descricao) ?? ''
        ];
        
        return $this->proc->buscaVerticais($params)->get();
    }

    public function show(Request $request): View
    {
        $verticais = $this->buscar($request);

        return view('midia-checking.cadastro.verticais.index', [
            'verticais' => $verticais
        ]);
    }

    public function new(Request $request): View
    {
        $tiposMidia = $this->proc->buscaTiposMidia([])->get();

        return view('midia-checking.cadastro.verticais.form', [
            'tiposMidia' => $tiposMidia
        ]);
    }
}
