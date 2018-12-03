<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";
    public $timestamps = false;

    public function categorias()
    {
    	return $this->BelongsTo("App\Modelos\Categoria", "id");
    }
}
