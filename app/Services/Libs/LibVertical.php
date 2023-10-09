<?php

namespace App\Services\Libs;

use App\Models\LibVertical as ModelsLibVertical;
use App\Services\CRUD;

class LibVertical extends CRUD
{
    public function __construct()
    {
        parent::__construct(new ModelsLibVertical());
    }

    /**
     * Busca as verticais.
     * 
     * @param array $params Array contendo os parâmetros para a realização de buscas específicas.
     */
    public function buscar($params = [])
    {
        $verticalId     = ($params['id']) ?? '';
        $tipoMidiaId    = ($params['tipo_midia_id']) ?? '';
        $descricao      = ($params['descricao']) ?? '';
        
        $this->model = $this->model->where('tipo_midia_id', '<>', 3);
        $this->model = ($verticalId)    ? $this->model->find($verticalId)   : $this->model;
        $this->model = ($tipoMidiaId)   ? $this->model->where('tipo_midia_id', '=', (int) $tipoMidiaId)  : $this->model;
        $this->model = ($descricao)     ? $this->model->where('descricao', '=', $descricao) : $this->model;

        return $this->model;
    }
}