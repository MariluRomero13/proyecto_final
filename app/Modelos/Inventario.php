<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    Protected $table = 'inventario';
	protected $primaryKey = 'id';
    public $timestamps = false;

    public function productos()
    {
    	return $this->belongsTo(Producto::class, 'producto_id', 'id');
    }

    public function detalle_inventario()
    {
    	return $this->hasMany(DetalleInventario::class,'inventario_id','id');
    }

    


}
