<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
 
class Producto extends Model
{
    Protected $table = 'productos';
	protected $primaryKey = 'id';
    public $timestamps = false;

    public function categorias()
    {
    	return $this->belongsTo(Categoria::class,'categoria_id','id');
    }

    public function inventario()
    {
    	return $this->HasMany(Inventario::class,'producto_id','id');
    }
   
}

