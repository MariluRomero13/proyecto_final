<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = "categorias";
    public $timestamps = false;

    public function Productos()
    {
    	return $this->HasMany("App\Modelos\Producto", "categoria", "id");
    }
}
