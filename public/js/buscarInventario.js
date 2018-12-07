$(document).ready(function() {
      $("#buscador").keyup(function(){
        var valor = $(this).val();
        var token = $("input[name=_token]").val();
        var td = "";
        var tabla = $("#cuerpo");
        tabla.html("");
        $("#error").html("");
        $.ajax({
          url: "/buscarinventario",
          data: {'valor': valor, _token: token},
          type: "POST",
          dataType: 'json',
          success: function(response)
          {
            if (response.status) 
            {
              
              $.each(response.inventario, function(i, v) {
                 td += "<tr>"
                 td +=("<td>"+v.code+"</td>");
                 td +=("<td>"+v.nombre+"</td>");
                 td +=("<td>"+v.stock_actual+"</td>");
                 td +=("<td>"+v.precio_compra+"</td>");
                 td +=("<td>"+v.precio_venta+"</td>");
                 td +=("<td>"+"<a class='btn btn-warning' href='/viewActualizarInventario/"+v.invid+"'>"+"<i class='fas fa-edit'>"+"</a>"+"</td>");
                 td +=("<td>"+"<a class='btn btn-danger' href='/eliminarInventario/"+v.invid+"'>"+"<i class='fas fa-times-circle'>"+"</a>"+"</td>");
                 td +=("<td>"+"<a class='btn btn-success' href=''>"+"<i class='far fa-eye'>"+"</a>"+"</td>");
                 td += "</tr>"
              });
              tabla.html(td);
              
            }
            if (response.status == 2) 
            { 
              
              $.each(response.todo, function(i, v) {
                 td += "<tr>"
                 td +=("<td>"+v.code+"</td>");
                 td +=("<td>"+v.nombre+"</td>");
                 td +=("<td>"+v.stock_actual+"</td>");
                 td +=("<td>"+v.precio_compra+"</td>");
                 td +=("<td>"+v.precio_venta+"</td>");
                 td +=("<td>"+"<a class='btn btn-warning' href='/viewActualizarInventario/"+v.invid+"'>"+"<i class='fas fa-edit'>"+"</a>"+"</td>");
                 td +=("<td>"+"<a class='btn btn-danger' href='/eliminarInventario/"+v.invid+"'>"+"<i class='fas fa-times-circle'>"+"</a>"+"</td>");
                 td +=("<td>"+"<a class='btn btn-success' href=''>"+"<i class='far fa-eye'>"+"</a>"+"</td>");
                 td += "</tr>"
              });
              tabla.html(td);
            }
            else {
              
              $("#error").html(response.error);
            }
          }
        }); 
      });
    });