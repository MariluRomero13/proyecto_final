@extends('layouts.base')

@section('css')
  <style> 
    #footerbuttons{
      width: 49%; 
      margin: 1% auto;
    }
  </style>
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
  <div class="row justify-content-md-center">
    <div class="col-12">
      <table class="table table-responsive" style="background-color: ; color: ;">
        <thead>
          <tr>
            <th>Producto</th>
            <th>Stock Actual</th>
            <th>Precio de Compro</th> 
            <th>Precio de venta</th>
            <th>Fecha de adquisicion</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
         @foreach($inventario as $i)
          <tr>
            <td>{{$i->producto_id}}</td>
            <td>{{$i->stock_actual}}</td>
            <td>{{$i->precio_compra}}</td> 
            <td>{{$i->precio_venta}}</td>
            <td>{{$i->fecha_adquisicion}}</td>
            <td><a href="{{"/viewActualizarInventario/$i->id"}}" class="btn btn-success active" role="button" aria-pressed="true">Actualizar</a></td>
            <td><a href="{{"/eliminarInventario/$i->id"}}" class="btn btn-primary active" role="button" aria-pressed="true">Eliminar</a></td>
          </tr>
         @endforeach
        </tbody>
      </table>
    </div>
  </div>
  

@endsection