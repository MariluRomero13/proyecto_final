<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HighCharts;
use App\Modelos\Producto;
use Illuminate\Support\Facades\DB;
use RezaAr\Highcharts\Facade as Chart;


class graficascontroller extends Controller
{
	function generar()
	{
		$grafica =  $this->generar_grafica();
		return view('graficas.vgrafica', compact("grafica"));
	}

	function generar_grafica()
	{
	$consulta = collect(DB::select('
select tabla.dia, tabla.total from (select date_format(ventas.fecha_venta, "%d") as dia, sum(detalle_ventas.subtotal) as total from detalle_ventas inner join ventas on detalle_ventas.venta_id = 
ventas.id group by date_format(ventas.fecha_venta, "%d") order by ventas.fecha_venta desc limit 4) as tabla order by tabla.dia;'));
	
		$dias = collect([]);
		$totales = collect([]);
		$consulta->each(function($r, $i)use($dias, $totales){
			$dias->push("Dia ".$r->dia);
			$totales->push($r->total);
		});


	    $chart = Chart::title([
	        'text' => 'Grafica de ventas',
	    ])
	    ->chart([
	        'type'     => 'line', 
	        'renderTo' => 'chart1', 
	    ])
	    ->subtitle([
	        'text' => 'Cantidad de ventas por dias',
	    ])
	    ->colors([
	        '#0c2959'
	    ])
	    ->xaxis([
	        'categories' => $dias,
	        'labels'     => [
	            'rotation'  => 15,
	            'align'     => 'top',
	        ],
	    ])
	    ->yaxis([
	        'text' => 'This Y Axis',
	    ])
	    ->legend([
	        'layout'        => 'vertikal',
	        'align'         => 'right',
	        'verticalAlign' => 'middle',
	    ])
	    ->series(
	        [
	            [
	                'name'  => 'Ingresos',
	                'data'  => $totales,
	                'color' => '#0c2959',
	            ],
	        ]
	    )
	    ->display();

	    return $chart;
	}
}
