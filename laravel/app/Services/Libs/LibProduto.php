<?php

namespace App\Services\Libs;

use App\Models\LibProduto as ModelsLibProduto;
use App\Services\CRUD;

class LibProduto extends CRUD
{
    public function __construct()
    {
        parent::__construct(new ModelsLibProduto());
    }

    /**
     * Buscar os produtos.
     * 
     * @param array $params Array contendo os parâmetros para a realização de buscas específicas.
     */
    public function buscar($params = [])
    {
        $produtoId = (array_key_exists('id', $params) && $params['id']) ? (int) $params['id'] : '';
        $verticalId = (array_key_exists('vertical_id', $params) && $params['vertical_id']) ? $params['vertical_id'] : '';
        
        $this->model = ($produtoId) ? $this->model->where('id', '=', $produtoId) : $this->model;
        $this->model = ($verticalId) ? $this->model->where('vertical_id', '=', $verticalId) : $this->model;
        
        return $this->model;
    }
}