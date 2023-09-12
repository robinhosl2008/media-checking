<?php

namespace App\Services;

use App\Models\LibTipoMidia as ModelLibTipoMidia;
use App\Models\LibVertical as ModelLibVertical;
use App\Models\LibProduto as ModelLibProduto;
use App\Services\Libs\LibTipoMidia;
use App\Services\Libs\LibVertical;
use App\Services\Libs\LibProduto;

class Proc
{
    private LibTipoMidia $libTipoMidia;
    private LibVertical $libVertical;
    private LibProduto $libProduto;

    public function __construct()
    {
        $this->libTipoMidia = new LibTipoMidia();
        $this->libVertical  = new LibVertical();
        $this->libProduto   = new LibProduto();
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
}