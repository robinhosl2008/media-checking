<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

    public function validaSenhaUsuario($arr)
    {
        $validator = Validator::make($arr, [
            'senha' => 'required|string',
            'confirma_senha' => 'required|string'
        ], [
            'senha' => ['senha', 'Informe uma senha para o usuário.'],
            'confirma_senha' => ['confirma_senha', 'Você não informou a senha ou não são iguais.']
        ]);
        
        return $validator;
    }

    public function salvar(StoreUsuarioRequest $request)
    {
        $validator = $request->validated();
        $aux = null;
        if (array_key_exists('id', $validator) && $validator['id']) {
            if (array_key_exists('troca_senha', $validator) && $validator['troca_senha']) {
                $aux = $this->validaSenhaUsuario($request->all());
            }
        } else {
            $aux = $this->validaSenhaUsuario($request->all());
        }

        if ($aux && $aux->stopOnFirstFailure()->fails()) {
            return redirect()
                ->route('criar-usuario')
                ->withErrors($validator)
                ->withInput();
        }
        

        dd($validator);
        
        

        // Valido as informações com o Laravel.


        // Envio para o método proc salvar o usuário.
    }

    public function update()
    {
        
    }
}