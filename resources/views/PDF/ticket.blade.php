<style type="text/css" media="print">
#Imprime {
 height: auto;
 width: 310px;
 font-family: Arial, Helvetica, sans-serif;
 font-size: 7px;
 color: gray;
 text-decoration-color: blue;
}
@page{
   margin: 0;
}
</style>

<div id="Imprime" align="center">
    <img src="imagenes/logo.png" align="center">
    <br><br>
    Miscelanea Don Jesus col. San Antonio, calle Benito Juarez #343 <br>
    Torreón, Coahuila<br>
    -----------------------------------------------------------------------------<br>
    MRCJ IT<br>
    -----------------------------------------------------------------------------<br>
    Fecha: {{$fecha}}<br>
    Tel: 8712782228<br><br>
    <table align="center">
        @foreach($ticket as $t)
      <tr>
        <td width="100" align="right">{{$t->codigo}} &nbsp;</td>
        <td width="50">{{$t->nombre}}</td>
        <td width="50" align="left">X {{$t->cantidad}} &nbsp; $</td>
        <td width="50">{{$t->subtotal}}</td>
      </tr>
      @endforeach
      <tr>
        <td></td>
        <td></td>
        <td align="right"><strong>Total:</strong></td>
        <td><strong>${{$total}}</strong></td>
      </tr>
    </table>
    <p><strong>
    -----------------------------------------------------------------------------<br>
    | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Gracias por su compra :')
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|<br>
    -----------------------------------------------------------------------------
    </strong></p>
</div>
