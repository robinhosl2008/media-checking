<?php

namespace App\Services;

use App\Services\Cadastro\Vertical;

class ProcVertical
{
    private Vertical $service;

    public function __construct()
    {
        $this->service = new Vertical();
    }

    public function buscar($params = [])
    {
        return $this->service->buscar($params);
    }

    public function salvarVertical($params = [])
    {
        $this->service->salvarVertical($params);
    }

    public function editaVertical($params = [])
    {
        $this->service->editaVertical($params);
    }

    public function removeVertical($params = [])
    {
        $this->service->removeVertical($params);
    }
}