<?php

namespace App\Services;

use App\Services\Cadastro\TipoMidia;

class ProcTipoMidia
{
    private TipoMidia $service;

    public function __construct()
    {
        $this->service = new TipoMidia();
    }

    public function buscar($params = [])
    {
        return $this->service->buscar($params);
    }

    public function salvarTipoMidia($params = [])
    {
        $this->service->salvarTipoMidia($params);
    }

    public function editaTipoMidia($params = [])
    {
        $this->service->editaTipoMidia($params);
    }

    public function removeTipoMidia($params = [])
    {
        $this->service->removeTipoMidia($params);
    }
}