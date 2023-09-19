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

    public function buscar(Request $request)
    {
        $params = [
            'usuario_id' => ($request->id) ?? '',
            'nome'       => ($request->nome) ?? '',
            'email'      => ($request->email) ?? ''
        ];
        
        return $this->proc->buscarUsuarios($params)->get();
    }

    public function show(Request $request): View
    {
        $usuarios = $this->buscar($request);

        return view('midia-checking.cadastro.usuarios.index', [
            'usuarios' => $usuarios
        ]);
    }

    public function form(Request $request): View
    {
        $usuario = [];
        if ($request->id)
            $usuario = $this->buscar($request)->first();
        
        return view('midia-checking.cadastro.usuarios.form', [
            'usuario' => $usuario 
        ]);
    }

    public function salvar(StoreUsuarioRequest $request)
    {
        $validador = $request->validated();

        dd($validador);
        // Valido as informações com o Laravel.


        // Envio para o método proc salvar o usuário.
    }

    public function update()
    {
        
    }
}