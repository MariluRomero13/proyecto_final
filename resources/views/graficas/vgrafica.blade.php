@extends("layouts.base")



@section("contenido")
<script src="//code.highcharts.com/highcharts.js"></script>
<script src="//code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>


<div id="chart1"></div>
	{!!$grafica!!}
@endsection