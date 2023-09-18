<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\Proc;

class UsuarioController extends Controller
{
    private Proc $proc;

    public function __construct()
    {
        $this->proc = new Proc();
    }

    public function show(Request $request): View
    {
        $usuarios = $this->proc->buscarUsuarios($request->all())->get();

        return view('midia-checking.cadastro.usuarios.index', [
            'usuarios' => $usuarios
        ]);
    }

    public function new(): View
    {
        return view('midia-checking.cadastro.usuarios.form');
    }
}