var contador = 0;
		var subtotal = [];
		var total = 0;
		var arreglo = [];

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
				}
				else {
					$("#agregar").show();
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

			$("#registrar").click(function(event) {
				
				var token = $("input[name=_token]").val();
				var divmensaje = $("#mensaje");
				$.ajax({
					url: "/registrarVenta",
					data: {_token: token, "producto": arreglo, "total": total},
					type: "POST",
					datatype: "json",
					success: function(response)
					{
						cancelar();
						divmensaje.html("<div class='alert alert-success text-center' role='alert'>"+"<strong>"+response.venta+"</strong>"+"</div>");

						divmensaje.delay(4000).hide(600);
					}
					
				});
			});

			$("#limpiar").click(function(event) {
				limpiar();
				ocultar();

			});
			$("#si").click(function(event) {
				cancelar();
			});
			
			
		});