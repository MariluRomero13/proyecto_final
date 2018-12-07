<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Modelos\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class pdfcontroller extends Controller
{
    function descargar()
    {
        $fecha = Carbon::now();
    	$ventas = DB::select('call generar_corte("'.$fecha->format('y-m-d').'")');    
    	$pdf = PDF::loadView("PDF.pdfprueba", compact("ventas", "fecha"));
    	return $pdf->download("Reporte_ventas_".$fecha->format('y-m-d').".pdf");
    }
}
