<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Requests\Usuario\EditarUsuarioRequest;
use App\Http\Requests\Usuario\SalvarUsuarioRequest;
use App\Http\Requests\Usuario\RemoverUsuarioRequest;
use App\Http\Controllers\Controller;
use App\Services\ProcUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Exception;

class UsuarioController extends Controller
{
    private ProcUsuario $proc;

    public function __construct()
    {
        $this->proc = new ProcUsuario();
    }

    public function buscar(Request $request)
    {
        $params = [
            'id'    => ($request->id) ?? '',
            'nome'  => ($request->nome) ?? '',
            'email' => ($request->email) ?? '',
            'dt_inicio' => ($request->dt_inicio) ?? '',
            'dt_fim' => ($request->dt_fim) ?? '',
        ];

        $usuarios = $this->proc->buscarUsuarios($params)->get();

        if ($request->getMethod() == 'POST') {
            return view('midia-checking.cadastro.usuarios.index', [
                'usuarios' => $usuarios,
                'params' => $params
            ]);
        } else {
            return $usuarios;
        }
    }

    public function listar(Request $request): View
    {
        $usuarios = $this->buscar($request);

        return view('midia-checking.cadastro.usuarios.index', [
            'usuarios' => $usuarios,
            'params' => []
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

        try {
            DB::beginTransaction();

            $this->proc->salvarUsuario($validated);

            DB::commit();

            return redirect('/cadastro/usuario')
                ->with('typeMessage', 'success')
                ->with('msg', 'Usuário cadastrado.');
        } catch(Exception $e) {
            DB::rollBack();

            return redirect('/cadastro/usuario')
                ->with('typeMessage', 'warning')
                ->with('msg', 'Um erro ocorreu ao salvar o novo usuário. ' . $e->getMessage());
        }
    }

    public function salvarEdicao(EditarUsuarioRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $this->proc->editaUsuario($validated);

            DB::commit();

            return redirect('/cadastro/usuario')
                ->with('typeMessage', 'success')
                ->with('msg', 'Usuário editado.');
        } catch(Exception $e) {
            DB::rollBack();

            return redirect('/cadastro/usuario')
                ->with('typeMessage', 'warning')
                ->with('msg', 'Um erro ocorreu ao tentar editar o usuário. ' . $e->getMessage());
        }
    }

    public function remover(RemoverUsuarioRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $this->proc->removeUsuario($validated);

            DB::commit();

            return redirect('/cadastro/usuario')
                ->with('typeMessage', 'success')
                ->with('msg', 'Usuário removido.');
        } catch(Exception $e) {
            DB::rollBack();
            
            return redirect('/cadastro/usuario')
                ->with('typeMessage', 'success')
                ->with('msg', 'Usuário removido.');
        }
    }
}