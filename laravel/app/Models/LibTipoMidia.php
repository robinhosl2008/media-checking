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

    public function vertical()
    {
        return $this->hasMany(LibVertical::class, 'tipo_midia_id');
    }
}
