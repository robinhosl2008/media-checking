<?php

namespace App\Services\Libs;

use App\Models\LibTipoMidia as ModelLibTipoMidia;
use App\Services\CRUD;

class LibTipoMidia extends CRUD
{
    public function __construct()
    {
        parent::__construct(new ModelLibTipoMidia());
    }

    /**
     * Busca pelos tipos de mídia.
     * 
     * @param array $params Array contendo os parâmetros para a realização de buscas específicas.
     */
    public function buscar($params = [])
    {
        $tipoMidiaId = (array_key_exists('tipo_midia_id', $params) && $params['tipo_midia_id']) ? $params['tipo_midia_id'] : '';
        
        $this->model = $this->model->where('id', '<>', 3);
        $this->model = ($tipoMidiaId) ? $this->model->find($tipoMidiaId) : $this->model;

        return $this->model;
    }
}