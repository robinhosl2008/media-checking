<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibProduto extends Model
{
    use HasFactory;
    
    /**
    * A tabela associada com a model.
    * 
    * @var string
    */
    protected $table = 'lib_produto';

    public function buscar($params)
    {
        $produtoId = (array_key_exists('produto_id', $params) && $params['produto_id']) ? $params['produto_id'] : '';
        
        $this->model = ($produtoId) ? $this->model->find($produtoId) : $this->model;

        return $this->model->get();
    }
}
