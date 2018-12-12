@extends("layouts.base")

@section("css")
<link rel="stylesheet" href="css/estilos.css">
@endsection

@section("menu")
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto">
            @if(Session::has("usuario"))
                <li class="nav-item active">
                    <a class="nav-link" href="#">Activo: {{ Session::get("usuario") }}</a>
                </li>
            @endif
            <li class="nav-item">
                <form action="{{ url('logout') }}" method="POST">
                    {{ csrf_field() }}
                    <button class="btn btn-danger" type="submit">Salir</button>
                </form>
            </li>
        </ul>
    </div>
@endsection

@section('contenido')

<div id="miModal" class="modal">
	<div class="flex" id="flex">
		<div class="contenido-modal">
			<div class="modal-header flex">
				<span class="close" id="close">&times;</span>
			</div>
			<div class="modal-body">
				<p class="text-center cancelar font-weight-normal">¿Estás seguro de cancelar?</p>			
			</div>
			<div class="footer text-right">
				<button class="btn btn-success" id="si">Si</button>
				<button class="btn btn-danger" id="no">No</button>
			</div>
		</div>
	</div>
</div>

<div id="miVenta" class="modal">
	<div class="flex" id="flex">
		<div class="contenido-modal">
			<div class="modal-header flex">
				<span class="close" id="close2">&times;</span>
			</div>
			<div class="modal-body">
				<label for="efectivo">Efectivo</label>
				<input type="number" id="efectivo">
				<p class="text-center cancelar font-weight-normal" id="cambio">Cambio: $0.0</p>
				<p class="cancelar font-weight-normal" id="totalp">Total: $0.0</p>
			</div>
			<div class="footer text-right">
				<button class="btn btn-success" id="vender" type="submit">Vender</button>
			</div>
		</div>
	</div>
</div>
<div class="row justify-content-md-center">
    <div class="col-10">
      <div class="card">
      <div class="card-header text-white bg-dark mb-3">
        Registrar Venta
      </div>
      <div class="card-body">
          {{ csrf_field() }}
          	<div class="form-row">
	          	<div class="form-group col-md-6">
	              <label for="codigo">Código</label>
	              <input id="codigo" type="number" class="form-control">
	            </div>
	        	<div class="form-group col-md-6">
	              <label for="producto">Producto</label>
	              <input id="producto" type="text" class="form-control" disabled>
	            </div>
        	</div>
        	<div class="form-row">
        		<div class="form-group col-md-4">
	              <label for="precio_v">Precio</label>
	              <input id="precio_v" type="text" class="form-control" disabled>
	            </div>
		        <div class="form-group col-md-4">
		            <label for="stock_a">Stock</label>
		            <input id="stock_a" type="text" class="form-control" disabled>
		        </div>
		        <div class="form-group col-md-4">
		            <label for="cantidad">Cantidad</label>
		            <input  type="number" class="form-control " id="cantidad" placeholder="Ingrese la cantidad">
		        </div>
	    	</div>
	      	<button type="reset" class="btn btn-primary" id="limpiar"><i class="fas fa-trash-alt"></i></button>
          	<button type="submit" class="btn btn-info" id="agregar">Agregar</button><br><br>
          	
          	<br>
          	<div class="col-md-10">
          		<table class="table table-responsive table-responsive-lg table-hover">
			        <thead>
			          <tr>
			            <th>Opciones</th>
			            <th>Articulo</th>
			            <th>Precio</th>
			            <th>Cantidad</th>
			            <th>Subtotal</th>
			          </tr>
			        </thead>
			        <tbody id="cuerpo">
			         	
			        </tbody>
			        <tfoot>
			        	<th>Total</th>
			        	<th></th>
			        	<th></th>
			        	<th></th>
			        	<th></th>
			        	<th><h5 id="total">$ 0.0</h5></th>
			        </tfoot>
		    	</table>
	        </div>
	        <div id="guardar">
	        	<button type="submit" class="btn btn-secondary" id="cancelar">Cerrar</button>
	        	<button type="submit" class="btn btn-success" id="registrar">Registrar</button>
	        </div>
          
         	<div id="mensaje"></div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section("javascript")
	<script>
		var subtotal = [];
var total = 0;
var arreglo = [];
var contador = 0;

function eliminar(index)
{
    total=total-subtotal[index]; 
    $("#total").html("$ " + total); 
    arreglo.splice(index, 1);
    $("#fila" + index).remove();
    habilitar();

}
function habilitar()
{
	if (total > 0) 
	{
		$("#guardar").show();
	}
	else {
		$("#guardar").hide();
		
	}
}
$(document).ready(function($) {

	var producto = $("#producto");
	var precio_v = $("#precio_v");
	var stock_a = $("#stock_a");
	var inventarioid = 0;
	var tabla = $("#cuerpo");

	
		 

	$( "#codigo" ).keypress(function( event ) {
		  var codigo = $(this).val();
		  var token = $("input[name=_token]").val();

		  if ( event.which == 13 )
		  {
	     	$.ajax({
	     		url: "/buscarproductoventa",
	     		data: {"valor":codigo, _token:token},
	     		type: "POST",
	     		datatype: "json",
	     		success: function(response)
	     		{
	     			if (response.status) 
	     			{
	     				$.each(response.productos, function(i, v) {
	     					inventarioid = v.invid;
		     				producto.val(v.nombre);
		     				precio_v.val(v.precio);
		     				stock_a.val(v.stock);
		     				ocultar();

	     				});

	     			}
	     			
	     		}
	     	});
	     	
		  }
		  
		  
	});

	$("#agregar").click(function(event) {
		 agregar();
		 
	});


	
	$("#guardar").hide();
	$("#agregar").hide();
	$("#cantidad").prop( "disabled", true );

	function agregar()
	{
		
		var pro = producto.val();
		var pv = precio_v.val();
		var st = stock_a.val(); 
		var cantidad = $("#cantidad").val();
		var fila = "";
		var sub = 0;
		var cont = 0 ;


		if (inventarioid !="" && cantidad !="" && cantidad > 0 && precio_v !="") 
		{
			cantidad = parseInt(cantidad);
			if (cantidad <= st) 
			{
				subtotal[contador] = (cantidad * pv);
				sub = subtotal[contador];
				total = total+subtotal[contador];
				cont = contador;

				
				fila += "<tr  id='fila"+contador+"'>";
				fila += '<td class="info">'+'<button type="button" class="btn btn-danger" onclick="eliminar('+contador+')">'+"<i class='fas fa-times-circle'>"+"</i>"+"</button>"+"</td>";
				fila += "<td class='info'>"+"<input type='hidden' class='form-control' name='pro[]' value='"+inventarioid+"'>"+pro+"</td>";
				fila += "<td class='info'>"+"<input type='hidden' class='form-control' name='precio_v[]' value='"+pv+"'>"+pv+"</td>";
				fila += "<td class='info'>"+"<input type='hidden' class='form-control' name='cantidad[]' value='"+cantidad+"'>"+cantidad+"</td>";
				fila += "<td class='info'>"+"<input type='hidden' class='form-control' name='subtotal[]' value='"+subtotal[contador]+"'>"+subtotal[contador]+"</td>";
				fila+= "</tr>";

				contador++;
				$("#total").html("$ " + total);
				limpiar();
				habilitar();
				arreglo.push([inventarioid,pro,pv,cantidad,sub]);
				tabla.append(fila);
				ocultar();
			}
			else {
				alert("No hay suficiente stock");
			}
		}
	}

	function limpiar()
	{
		producto.val("");
		precio_v.val("");
		$("#cantidad").val("");
		stock_a.val("");
		$("#codigo").val("");
	}


	
	function ocultar()
	{
		if ($("#codigo").val() == "") 
		{
			$("#agregar").hide();
			$("#cantidad").prop( "disabled", true );
		}
		else {
			$("#agregar").show();
			$("#cantidad").prop( "disabled", false );
			
		}
	}

	function cancelar()
	{
		limpiar();
		ocultar();
		total = 0;
		subtotal = [];
		arreglo = [];
		contador = 0;
		habilitar();
		tabla.html("");
		$("#total").html("$ 0.0");
	}

	$("#limpiar").click(function(event) {
		limpiar();
		ocultar();

	});

	$("#si").click(function(event) {
		cancelar();
	});

	$("#registrar").click(function(event) {
		$("#totalp").html("Total: $"+total);
	});

	$("#vender").click(function(event) {
		var token = $("input[name=_token]").val();
		var divmensaje = $("#mensaje");
		$.ajax({
			url: "/registrarVenta",
			data: {_token: token, "producto": arreglo, "total": total},
			type: "POST",
			datatype: "json",
			success: function(response)
			{	
				
				$("#totalp").html("Total: $0.0");
				$("#cambio").html("Cambio: $0.0");
				let venta = document.getElementById('miVenta');
				venta.style.display = 'none';
				cancelar();
				divmensaje.html("<div class='alert alert-success text-center' role='alert'>"+"<strong>"+val+"</strong>"+"</div>");
				divmensaje.delay(4000).hide(600);

			}
			
		});
	});

	

	$("#efectivo").keypress(function( event ) {
		//alert("Hi");
		var efectivo = $(this).val();
		var cambio = $("#cambio");
	  	var cambio2 = 0;

		  if ( event.which == 13 )
		  {
	     		efectivo = parseFloat(efectivo);
	     		if (efectivo <  total) 
	     		{
	     			alert("Le falta efectivo");
	     		}
	     		
	     		else {
	     			cambio2 = efectivo - total ;
	     			cambio.html("Cambio: $"+cambio2);
	     		}
	     		
		  }
		 
	});
	
	
});
	</script>











	<script>
		let modal = document.getElementById('miModal');
		let flex = document.getElementById('flex');
		let abrir = document.getElementById('cancelar');
		let cerrar = document.getElementById('close');
		let no = document.getElementById('no');
		let si = document.getElementById('si');
		let registrar = document.getElementById('registrar');
		let venta = document.getElementById('miVenta');
		let cerrar2 = document.getElementById('close2');

		registrar.addEventListener('click', function(){
		    venta.style.display = 'block';
		});

		abrir.addEventListener('click', function(){
		    modal.style.display = 'block';
		});

		cerrar.addEventListener('click', function(){
		    modal.style.display = 'none';
		});

		cerrar2.addEventListener('click', function(){
		    venta.style.display = 'none';
		});

		no.addEventListener('click', function(){
		    modal.style.display = 'none';
		});

		si.addEventListener('click', function(){
		    modal.style.display = 'none';
		});

		window.addEventListener('click', function(e){
		    console.log(e.target);
		    if(e.target == flex){
		        modal.style.display = 'none';
		    }
		});

		window.addEventListener('click', function(e){
		    console.log(e.target);
		    if(e.target == flex){
		        venta.style.display = 'none';
		    }
		});
	</script>
@endsection

