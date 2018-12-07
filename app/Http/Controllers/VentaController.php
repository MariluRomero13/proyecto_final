<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Modelos\Venta;
use App\Modelos\DetalleVenta;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;

class VentaController extends Controller
{	
	public function mostrar_ventas()
	{
		$ventas = Venta::paginate(5);
    	return view("ventas.mostrar", compact("ventas"));
	}

	public function index()
	{
		return view("ventas.crear");
	}

	public function registrarVenta(Request $r)
	{
		
		$fecha = Carbon::now(); 
		$venta = new Venta();
		$venta->total = $r->get("total");
		$venta->fecha_venta = $fecha;
		$venta->save();

		
		$producto = $r->get("producto");
		$producto = Collection::make($producto);

		$id_venta = Venta::all();
		$producto->each(function ($i,$k)use($id_venta){	
			$dv = new DetalleVenta();
			$dv->venta_id = $id_venta->last()->id;
            $dv->inventario_id = $i[0];
			$dv->cantidad = $i[3];
			$dv->precio_venta = $i[2];
			$dv->subtotal = $i[4];
			$dv->save();
        });
        
		return ["venta"=>"Venta registrada satisfactoriamente"];
		
	}

	public function buscar_venta(Request $r)
	{
		$venta = Venta::all()->where("id","=",$r->get("valor"));
		if ($venta->count() > 0) 
		{
			return ["status" => 1, "venta" => $venta];
		}
		if ($r->get("valor") == "") 
		{
			$ventas = Venta::all();
			return ["status" => 2, "ventas" => $ventas];

		}
		return ["status" => 0, "error" => "Folio no encontrado"];
	}

	public function mostrar_detalles($id)
	{
		$busqueda = DB::table("categorias")
			->join("productos","categoria_id","=","categorias.id")
			->join("inventario","producto_id","=","productos.id")
			->join("detalle_ventas","inventario_id","=","inventario.id")
			->join("ventas","ventas.id","=","detalle_ventas.venta_id")
			->select("categorias.nombre as categoria","productos.codigo as codigo","productos.nombre","inventario.precio_venta","detalle_ventas.cantidad","detalle_ventas.subtotal","ventas.total")
			->where("ventas.id","=",$id)->get();

		return view("ventas.mostrardetalle", compact("busqueda"));
	}
}

