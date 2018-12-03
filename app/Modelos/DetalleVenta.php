<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = "detalle_ventas";
    protected $id = "id";
    public $timestamps = false;

    public function inventario()
    {
    	return $this->belongsto(Inventario::class, "inventario_id","id");
    }
    public function ventas()
    {
    	return $this->belongsto(Venta::class, "venta_id","id");
    }
}
