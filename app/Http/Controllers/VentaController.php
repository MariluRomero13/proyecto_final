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
use Barryvdh\DomPDF\Facade as PDF;
use Response;


class VentaController extends Controller
{	
	function __construct()
    {
         $this->middleware('verificador');
    }
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
		
		//dd($r);
		$fecha = Carbon::now(); 
		$venta = new Venta();
		$venta->total = $r->get("total");
		$venta->fecha_venta = $fecha;
		$venta->save();

		$id_venta = Venta::all();
		
		$producto = $r->get("pro");
		$producto = Collection::make($producto);
		$precio_venta = $r->get("precio_v");
		$cantidad = $r->get("cantidad");
		$subtotal = $r->get("subtotal");

		for ($i=0; $i < $producto->count() ; $i++) { 
			$dv = new DetalleVenta();
			$dv->venta_id = $id_venta->last()->id;
            $dv->inventario_id = $producto[$i];
			$dv->cantidad = $cantidad[$i];
			$dv->precio_venta = $precio_venta[$i];
			$dv->subtotal = $subtotal[$i];
			$dv->save();
		}


        $ticket = DB::select("call generar_ticket(".$id_venta->last()->id.")");
        $total = Venta::all()->where("id", "=", $id_venta->last()->id)->first()->total;
        $fecha = Carbon::now()->format('d-m-y');
        $pdf = PDF::LoadView("PDF.ticket", compact("ticket", "total", "fecha"));
        return $pdf->download($id_venta->last()->id."ticket.pdf");
        
        
	
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

	public function eliminar_venta($id)
	{
		Venta::destroy($id);
		return redirect()->route("ventas");
	}
}

