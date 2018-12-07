$(document).ready(function($) {
    $("#buscador").keyup(function(event) {
        var valor = $(this).val();
        var token = $("input[name=_token]").val();
        var td = "";
        var tabla = $("#cuerpo");
        tabla.html("");
        $("#error").html("");
        $.ajax({
          url: "/buscarventa",
          data: {"valor": valor, _token: token},
          type: "POST",
          datatype: "json",
          success: function(response)
          {
              if (response.status) 
              {
                  $.each(response.venta, function(index, v) {
                       td += "<tr>"
                       td +=("<td>"+v.id+"</td>");
                       td +=("<td>"+v.fecha_venta+"</td>");
                       td +=("<td>"+v.total+"</td>");
                       td +=("<td>"+"<a class='btn btn-success' href='/mostrarDetalles/"+v.id+"'>"+"<i class='far fa-eye '>"+"</a>"+"</td>");
                       td +=("<td>"+"<a class='btn btn-danger' href='//"+v.id+"'>"+"<i class='fas fa-times-circle'>"+"</a>"+"</td>");
                       td += "</tr>";
                  });
                  tabla.html(td);
              }
              if (response.status == 2) 
              {
                  $.each(response.ventas, function(index, v) {
                       td += "<tr>"
                       td +=("<td>"+v.id+"</td>");
                       td +=("<td>"+v.fecha_venta+"</td>");
                       td +=("<td>"+v.total+"</td>");
                       td +=("<td>"+"<a class='btn btn-success' href='/mostrarDetalles/"+v.id+"'>"+"<i class='far fa-eye '>"+"</a>"+"</td>");
                       td +=("<td>"+"<a class='btn btn-danger' href='//"+v.id+"'>"+"<i class='fas fa-times-circle'>"+"</a>"+"</td>");
                       td += "</tr>";
                  });
                  tabla.html(td);
              }
              else 
              {
              
                $("#error").html(response.error);
             }
          }
        });
    });
  });