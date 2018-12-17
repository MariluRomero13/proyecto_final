var subtotal = [];
var total = 0;
var arreglo = [];
var contador = 0;
var producto = $("#producto");
var precio_v = $("#precio_v");
var stock_a = $("#stock_a");
var inventarioid = 0;
var tabla = $("#cuerpo");

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
		$("#registrar").prop( "disabled", false );
		$("#cancelar").prop( "disabled", false );
		
	}
	else {
		$("#registrar").prop( "disabled", true );
		$("#cancelar").prop( "disabled", true );
		
		
	}
}
function limpiar()
{
	producto.val("");
	precio_v.val("");
	$("#cantidad").val(1);
	stock_a.val("");
	$("#codigo").val("");
}

	   
function ocultar()
{
	if ($("#codigo").val() == "") 
	{
		$("#agregar").prop( "disabled", true );
		$("#cantidad").prop( "disabled", true );
	}
	else {
		$("#agregar").prop( "disabled", false );
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
$(document).ready(function($) {

	
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


	
	$("#cancelar").prop( "disabled", true );
	$("#registrar").prop( "disabled", true );
	$("#agregar").prop( "disabled", true );
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
				$("input[name=total]").val(total);
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

	

	$("#registrar").click(function(event) {
		$("#totalv").html("Total: $"+total);

	});

	$("#cerrar").click(function(event) {
		cancelar();
		limpiar();
		habilitar();
		ocultar();
		$("#efectivo").val(0);
		$("#totalv").html("Total: $0.0");
		$("#cambio").html("Cambio: $0.0");

	});

	$("#limpiar").click(function(event) {
		limpiar();
		ocultar();

	});

	$("#si").click(function(event) {
		//cancelar();
	});

	$("#vender").click(function(event) {
		if ($("#efectivo").val() == "") 
		{
			alert("Ingresa el efectivo");
		}
	});

	

	$("#calcular").click(function( event ) {
		//alert("Hi");
		var efectivo = $("#efectivo").val();
		var cambio = $("#cambio");
	  	var cambio2 = 0;

 		efectivo = parseFloat(efectivo);
 		total = parseFloat(total);
 		if (efectivo <  total) 
 		{
 			alert("Le falta efectivo");
 			$("#vender").prop( "disabled", true );
 		}
 		
 		else 
 		{
 			cambio2 = efectivo - total ;
 			cambio.html("Cambio: $"+cambio2);
 			$("#vender").prop( "disabled", false );
 			
 		}
	     		
	});
	
	
});	