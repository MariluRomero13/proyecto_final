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
        $total = 0;

        $fecha = Carbon::now();
    	$ventas = DB::select('call generar_corte("'.$fecha->format('y-m-d').'")'); 
        foreach ($ventas as $tot) {
            $total += $tot->subtotal;
        }
    	$pdf = PDF::loadView("PDF.pdfprueba", compact("ventas", "fecha", "total"));
    	return $pdf->download("Reporte_ventas_".$fecha->format('y-m-d').".pdf");
    }
}
