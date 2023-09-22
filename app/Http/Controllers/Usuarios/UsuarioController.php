<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Requests\Usuario\EditarUsuarioRequest;
use App\Http\Requests\Usuario\SalvarUsuarioRequest;
use App\Http\Requests\Usuario\RemoverUsuarioRequest;
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
            'id'    => ($request->id) ?? '',
            'nome'  => ($request->nome) ?? '',
            'email' => ($request->email) ?? ''
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

    public function salvarCriacao(SalvarUsuarioRequest $request)
    {
        $validated = $request->validated();

        // dd($validated);
        return redirect('/cadastro/usuario')->with('msg', 'Usuário cadastrado.');
    }

    public function salvarEdicao(EditarUsuarioRequest $request)
    {
        $validated = $request->validated();

        // dd($validated);
        return redirect('/cadastro/usuario')->with('msg', 'Usuário editado.');
    }

    public function remover(RemoverUsuarioRequest $request)
    {
        $validated = $request->validated();

        // dd($validated);
        return redirect('/cadastro/usuario')->with('msg', 'Usuário removido.');
    }
}