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

    public function show(Request $request): View
    {
        $tiposMidia = $this->proc->buscaTiposMidia($request->all())->get();

        return view('midia-checking.cadastro.tipos-midia.index', [
            'tiposMidia' => $tiposMidia
        ]);
    }

    public function new(): View
    {
        return view('midia-checking.cadastro.tipos-midia.form');
    }
}