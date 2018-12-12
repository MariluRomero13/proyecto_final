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
        
        $fecha = Carbon::now()->format('y-m-d');
        $dia = Carbon::now()->format('d');
        $mes = Carbon::now()->format('m');
        $ano = Carbon::now()->format('y');
    	$ventas = collect(DB::select('call generar_corte("'.$fecha.'")')); 
        $folio = $ano.$mes.$dia.$ventas->first()->id."-".$ventas->last()->id;
        foreach ($ventas as $tot) {
            $total += $tot->subtotal;
        }
        
    	$pdf = PDF::loadView("PDF.pdfprueba", compact("ventas", "dia", "mes", "ano", "total", "folio"));
    	return $pdf->download("Reporte_ventas_".$fecha.".pdf");
    }

    function ticket()
    {
        $ticket = DB::select("call generar_ticket('2')");
        $total = Venta::all()->where("id", "=", 2)->first()->total;
        $fecha = Carbon::now()->format('d-m-y');
        $pdf = PDF::LoadView("PDF.ticket", compact("ticket", "total", "fecha"));
        return $pdf->download("hola.pdf");
    }
}
