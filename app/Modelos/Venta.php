<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    Protected $table = 'ventas';
	protected $primaryKey = 'id';
    public $timestamps = false;

    
    public function detalle_ventas()
    {
    	return $this->hasMany(DetalleVentas::class,'ventas_id','id');
    }
}
