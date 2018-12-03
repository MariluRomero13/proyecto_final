<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class DetalleInventario extends Model
{
    protected $table = "detalle_inventario";
    protected $id = "id";
    public $timestamps = false;

    public function inventario()
    {
    	return $this->belongsto(Inventario::class, "inventario_id","id");
    }


}
