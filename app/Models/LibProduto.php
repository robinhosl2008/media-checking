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
}
