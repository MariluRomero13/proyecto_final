<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Modelos\Venta;
use App\Modelos\DetalleVenta;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;

class VentaController extends Controller
{	
	public function mostrar_ventas()
	{
		$ventas = Venta::all();
    	return view("ventas.mostrar", compact("ventas"));
	}

	public function index()
	{
		return view("ventas.crear");
	}

	public function registrarVenta(Request $r)
	{
	
		return($r->get("producto"));
		
	}
}
