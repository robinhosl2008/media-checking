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
        $usuario_id = ($params['usuario_id']) ?? '';

        $this->model = ($usuario_id) ? $this->model->find($usuario_id) : $this->model;

        return $this->model;
    }
}