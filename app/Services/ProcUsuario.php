<?php

namespace App\Services;

use App\Helpers\Data;
use App\Services\Cadastro\Usuario;

class ProcUsuario extends Data
{
    private Usuario $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
    }

    public function buscarUsuarios($params = [])
    {
        return $this->usuario->buscar($params);
    }

    public function salvarUsuario($params = [])
    {
        $this->usuario->salvarUsuario($params);
    }

    public function editaUsuario($params = [])
    {
        $this->usuario->editaUsuario($params);
    }

    public function removeUsuario($params = [])
    {
        $this->usuario->removeUsuario($params);
    }
}