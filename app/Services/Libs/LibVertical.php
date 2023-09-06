<?php

namespace App\Services\Libs;

use App\Models\LibVertical as ModelsLibVertical;

class LibVertical
{
    private ModelsLibVertical $model;

    public function __construct()
    {
        $this->model = new ModelsLibVertical();
    }

    public function buscar($params)
    {
        $verticalId = (array_key_exists('vertical_id', $params) && $params['vertical_id']) ? $params['vertical_id'] : '';
        
        $this->model = ($verticalId) ?$this->model->find($verticalId) : $this->model;

        return $this->model->get();
    }
}