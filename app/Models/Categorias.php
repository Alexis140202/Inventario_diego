<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        // Add your fillable fields here
    ];

    public function marcas()
    {
        return $this->hasMany(\App\Models\Marca::class, 'categoria_id');
    }
}
