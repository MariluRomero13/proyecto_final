$(document).ready(function($) {
        $("#buscador").keyup(function(event) {
            var valor = $(this).val();
            var token = $("input[name=_token]").val();
            var info = "";
            var carta = $("#cuerpo");
            carta.html("");
            $("#error").html("");
            $.ajax({
              url: "/buscarproducto",
              data: {'valor': valor, _token: token},
              type: "POST",
              dataType: 'json',
              success: function(response)
              {
                if (response.status) 
                {
                  
                    $.each(response.productos, function(i, v) {
                      info+=("<div class='card' style='width: 17rem; margin-left: 2%;'>");
                      info+=("<img class='card-img-top' src='/imagenes/imagenes_productos/"+v.imagen+"' alt='Card image cap' class='img-fluid' style='width: 16.5rem; height: 17rem;'>");
                      info+=("<div class='card-body'>"+"<h5 class='card-title'>"+v.id+" - "+v.nombre+"</h5>"+"</div>");
                      info+=("<div class='card-footer'>");
                      info+=("<a href='/seleccionarproducto/"+v.id+"' class='btn btn-warning'>"+"<i class='fas fa-edit'>"+"</i>"+"</a>");
                      info+=(" " + "<a href='/eliminar/"+v.id+"' class='btn btn-danger'>"+"<i class='fas fa-times-circle'>"+"</i>"+"</a>");
                      info+=(" " + "<a href='/vermasproductos/"+v.id+"' class='btn btn-success'>"+"<i class='far fa-eye'>"+"</i>"+"</a>");
                      info+=("</div>");
                      info+=("</div>");
                    });
                    carta.html(info);
                }
                if (response.status == 2) 
                {
                     $.each(response.todo, function(i, v) {
                     info+=("<div class='card' style='width: 17rem; margin-left: 2%;'>");
                      info+=("<img class='card-img-top' src='/imagenes/imagenes_productos/"+v.imagen+"' alt='Card image cap' class='img-fluid' style='width: 16.5rem; height: 17rem;'>");
                      info+=("<div class='card-body'>"+"<h5 class='card-title'>"+v.id+" - "+v.nombre+"</h5>"+"</div>");
                      info+=("<div class='card-footer'>");
                      info+=("<a href='/seleccionarproducto/"+v.id+"' class='btn btn-warning'>"+"<i class='fas fa-edit'>"+"</i>"+"</a>");
                      info+=(" " + "<a href='/eliminar/"+v.id+"' class='btn btn-danger'>"+"<i class='fas fa-times-circle'>"+"</i>"+"</a>");
                      info+=(" " + "<a href='/vermasproductos/"+v.id+"' class='btn btn-success'>"+"<i class='far fa-eye'>"+"</i>"+"</a>");
                      info+=("</div>");
                      info+=("</div>");
                  });
                  carta.html(info);
                }
                else {
                
                  $("#error").html(response.error);
                }
               
            }
        }); 
      });
    });