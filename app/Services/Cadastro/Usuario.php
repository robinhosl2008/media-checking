<?php

namespace App\Services\Cadastro;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Services\CRUD;
use App\Models\User;
use Exception;

class Usuario extends CRUD
{
    public function __construct()
    {
        parent::__construct(new User());
    }

    public function buscar($params = [])
    {
        $id         = ((int) $params['id']) ?? '';
        $nome       = ($params['nome']) ?? '';
        $email      = ($params['email']) ?? '';
        $dt_inicio  = ($params['dt_inicio']) ?? '';
        $dt_fim     = ($params['dt_fim']) ?? '';

        if ($id){
            $this->model = $this->model->where('id', '=', $id);
        }

        if ($dt_inicio) {
            $this->model = $this->model->where('created_at', '>=', $dt_inicio);
        }

        if ($dt_fim) {
            $this->model = $this->model->where('created_at', '<=', $dt_fim);
        }

        $this->model = ($nome) ? $this->model->where(DB::raw('lower(name)'), 'LIKE', "%$nome%") : $this->model;
        $this->model = ($email) ? $this->model->where(DB::raw('lower(email)'), 'LIKE', "%$email%") : $this->model;
        $this->model = $this->model->orderByDesc('id');

        return $this->model;
    }

    public function salvarUsuario($params = [])
    {
        $nome   = ($params['nome']) ?? throw new Exception('O nome do usuário não foi informado.', 1);
        $email  = ($params['email']) ?? throw new Exception('O e-mail do usuário não foi informado.', 1);
        $senha          = ($params['senha']) ? Hash::make($params['senha']) : throw new Exception('A senha do usuário não foi informada.', 1);
        $confirma_senha = ($params['confirma_senha']) ?? throw new Exception('Os e-mails do usuário não são iguais ou não foram informados.', 1);
        
        $this->model->name      = $nome;
        $this->model->email     = $email;
        $this->model->password  = $senha;

        if (!$this->model->save()) {
            throw new Exception('Um erro ocorreu ao tentar salvar o novo usuário.', 1);
        }
    }

    public function editaUsuario($params = [])
    {
        $id = ($params['id']) ?? throw new Exception('Não foi possível encontrar o usuário.');

        if (!$id) {
            throw new Exception('Não foi possível encontrar o usuário.');
        }

        $this->model = $this->model->where('id', '=', (int) $id)->get()->first();

        $nome   = ($params['nome']) ?? throw new Exception('O nome do usuário não foi informado.', 1);
        $email  = ($params['email']) ?? throw new Exception('O e-mail do usuário não foi informado.', 1);
        
        $this->model->name  = $nome;
        $this->model->email = $email;

        $troca_senha = ($params['troca_senha']) ?? '';
        if ($troca_senha) {
            $senha          = ($params['senha']) ? Hash::make($params['senha']) : throw new Exception('A senha do usuário não foi informada.', 1);
            $confirma_senha = ($params['confirma_senha']) ?? throw new Exception('Os e-mails do usuário não são iguais ou não foram informados.', 1);

            $this->model->password = $senha;
        }

        $this->model->save();
    }

    public function removeUsuario($params = [])
    {
        $id = ($params['id']) ?? throw new Exception('Não foi possível encontrar o usuário.');
        
        if (!$id) {
            throw new Exception('Não foi possível encontrar o usuário.');
        }

        $this->model = $this->model->where('id', '=', (int) $id)->get()->first();
        $this->model->delete();
    }
}