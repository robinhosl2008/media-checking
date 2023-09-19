<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibVertical extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lib_vertical';

    public function tipoMidia()
    {
        return $this->belongsTo(LibTipoMidia::class, 'tipo_midia_id');
    }
}
