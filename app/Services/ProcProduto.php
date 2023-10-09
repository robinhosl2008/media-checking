<?php

namespace App\Services;

use App\Services\Cadastro\Produto;

class ProcProduto
{
    private Produto $service;

    public function __construct()
    {
        $this->service = new Produto();
    }

    public function buscar($params = [])
    {
        return $this->service->buscar($params);
    }

    public function salvarProduto($params = [])
    {
        $this->service->salvarProduto($params);
    }

    public function editaProduto($params = [])
    {
        $this->service->editaProduto($params);
    }

    public function removeProduto($params = [])
    {
        $this->service->removeProduto($params);
    }
}