<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Requests\StoreUsuarioRequest;
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

    public function form(Request $request): View
    {
        return view('midia-checking.cadastro.usuarios.form');
    }

    public function salvar(StoreUsuarioRequest $request)
    {
        $validador = $request->validated();

        dd($validador);
        // Valido as informações com o Laravel.


        // Envio para o método proc salvar o usuário.
    }
}