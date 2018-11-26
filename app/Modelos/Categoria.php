<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    Protected $table = 'categorias';
	protected $primaryKey = 'id';
    public $timestamps = false;

    public function productos()
    {
    	return $this->HasMany(Producto::class,'categoria_id','id');
    }
}
