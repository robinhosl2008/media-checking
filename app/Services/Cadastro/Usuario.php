<?php

namespace App\Services\Cadastro;

use App\Models\User;
use App\Services\CRUD;

class Usuario extends CRUD
{
    public function __construct()
    {
        parent::__construct(new User());
    }

    public function buscar($params = [])
    {
        $id             = ((int) $params['id']) ?? '';
        $usuario_nome   = ($params['nome']) ?? '';
        $usuario_email  = ($params['email']) ?? '';

        if($id){
            $this->model = $this->model->where('id', '=', $id);
        }

        $this->model = ($usuario_nome) ? $this->model->where('name', 'LIKE', "%{$usuario_nome}%") : $this->model;
        $this->model = ($usuario_email) ? $this->model->where('email', 'LIKE', "%{$usuario_email}%") : $this->model;

        return $this->model;
    }
}