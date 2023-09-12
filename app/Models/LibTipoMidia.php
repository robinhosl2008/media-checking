<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibTipoMidia extends Model
{
    use HasFactory;

    /**
     * A tabela associada com a model.
     * 
     * @var string
     */
    protected $table = 'lib_tipo_midia';

    public function buscar($params)
    {
        $tipoMidiaId = (array_key_exists('tipo_midia_id', $params) && $params['tipo_midia_id']) ? $params['tipo_midia_id'] : '';
        
        $this->model = ($tipoMidiaId) ? $this->model->find($tipoMidiaId) : $this->model;

        return $this->model->get();
    }
}
