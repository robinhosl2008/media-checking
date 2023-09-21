<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Requests\StoreEdicaoUsuarioRequest;
use App\Http\Requests\StoreNovoUsuarioRequest;
use App\Http\Requests\DestroyUsuarioRequest;
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

    public function listar(Request $request): View
    {
        $usuarios = $this->buscar($request);

        return view('midia-checking.cadastro.usuarios.index', [
            'usuarios' => $usuarios
        ]);
    }

    public function criar(Request $request): View
    {
        return view('midia-checking.cadastro.usuarios.criar', [
            'usuario' => []
        ]);
    }

    public function editar(Request $request): View
    {
        $usuario = [];
        if ($request->id)
            $usuario = $this->buscar($request)->first();
        
        return view('midia-checking.cadastro.usuarios.editar', [
            'usuario' => $usuario 
        ]);
    }

    public function salvarCriacao(StoreNovoUsuarioRequest $request)
    {
        $validator = $request->validated();
        

        dd($validator);
        
        

        // Valido as informações com o Laravel.


        // Envio para o método proc salvar o usuário.
    }

    public function salvarEdicao(StoreEdicaoUsuarioRequest $request)
    {
        $validator = $request->validated();

        
        dd($validator);
        
        

        // Valido as informações com o Laravel.


        // Envio para o método proc salvar o usuário.
    }

    public function remover(DestroyUsuarioRequest $request)
    {
        $validator = $request->validated();

        
        dd($validator);
    }
}