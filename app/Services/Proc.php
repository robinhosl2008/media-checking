<?php

namespace App\Services;

use App\Services\Cadastro\Usuario;
use App\Services\Libs\LibTipoMidia;
use App\Services\Libs\LibVertical;
use App\Services\Libs\LibProduto;

class Proc
{
    private LibTipoMidia $libTipoMidia;
    private LibVertical $libVertical;
    private LibProduto $libProduto;
    private Usuario $usuario;

    public function __construct()
    {
        $this->libTipoMidia = new LibTipoMidia();
        $this->libVertical  = new LibVertical();
        $this->libProduto   = new LibProduto();
        $this->usuario      = new Usuario();
    }

    public function buscaTiposMidia($params = [])
    {
        return $this->libTipoMidia->buscar($params);
    }

    public function buscaVerticais($params = [])
    {
        return $this->libVertical->buscar($params);
    }

    public function buscaProdutos($params = [])
    {
        return $this->libProduto->buscar($params);
    }

    public function buscarUsuarios($params = [])
    {
        return $this->usuario->buscar($params);
    }
}