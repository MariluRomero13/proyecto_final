<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="Expires" content="0" />
    <meta http-equiv="Pragma" content="no-cache" />
	<title>Sistema de ventas MRCJ</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="{{'css/styles.css'}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/corte.css">
    <title>Corte de caja</title>
</head>
<body>
	<div class="">
        <table width="100%" class="tabla1">
            <tr>
                <td width="73%" align="center"><img id="logo" src="imagenes/logo.png" alt="" width="255" height="100"></td>
                <td width="27%" rowspan="3" align="center" style="padding-right:0">
                    <table width="100%">
                        <tr>
                            <td height="40" align="center" class="border fondo"><span class="h1">Corte de caja</span></td>
                        </tr>
                        <tr>
                            <td height="70" align="center" class="border">{{$folio}}- Nº <span class="text">Folio</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table width="30%" class="tabla2">
            <tr>
                <td width="4%">&nbsp;</td>
                <td width="7%" align="center" class="border fondo"><strong>DÍA</strong></td>
                <td width="8%" align="center" class="border fondo"><strong>MES</strong></td>
                <td width="7%" align="center" class="border fondo"><strong>AÑO</strong></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td align="center" class="border"><span class="text">{{$dia}}</span></td>
                <td align="center" class="border"><span class="text">{{$mes}}</span></td>
                <td align="center" class="border"><span class="text">{{$ano}}</span></td>
            </tr>
        </table>
        <table width="100%" class="tabla3">
            <tr>
                <td align="center" class="fondo"><strong>CODIGO</strong></td>
                <td align="center" class="fondo"><strong>PRODUCTO</strong></td>
                <td align="center" class="fondo"><strong>CATEGORIA</strong></td>
                <td align="center" class="fondo"><strong>CANTIDAD</strong></td>
                <td align="center" class="fondo"><strong>P. UNITARIO</strong></td>
                <td align="center" class="fondo"><strong>SUBTOTAL</strong></td>
            </tr>
            @foreach($ventas as $venta)
            <tr>
                <td width="10%" align="center"><span class="text">{{$venta->codigo}}</span></td>
                <td width="16%"><span class="text">{{$venta->producto}}</span></td>
                <td width="16%" align="left"><span class="text">{{$venta->categoria}}</span></td>
                <td width="8%" align="right"><span class="text">{{$venta->cantidad}}</span></td>
                <td width="8%" align="right"><span class="text">$ {{$venta->precio_unitario}}</span></td>
                <td width="10%" align="right"><span class="text">$ {{$venta->subtotal}}</span></td>
            </tr>
            @endforeach
            <tr>
                <td style="border:0;">&nbsp;</td>
                <td style="border:0;">&nbsp;</td>
                <td style="border:0;">&nbsp;</td>
                <td style="border:0;">&nbsp;</td>
                <td align="right"><strong>TOTAL</strong></td>
                <td align="right"><span class="text"><strong>$ {{$total}}</strong></span></td>
            </tr>
        </table>
    </div>
</body>
</html>