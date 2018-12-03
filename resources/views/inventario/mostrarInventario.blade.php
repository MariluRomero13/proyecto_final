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
  <div>
    <div class="form-inline">
      @csrf
      <label class="sr-only" for="inlineFormInputGroupUsername2">Buscar</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-search"></i></div>
          </div>
          <input type="text" class="form-control" id="buscador" placeholder="Buscar...">
        </div>
    </div>
  </div>
  <br>
  <div class="row justify-content-md-center">
    <div class="col-12">
      <table class="table table-responsive" style="background-color: ; color: ;">
        <thead>
          <tr>
            <th>Código</th>
            <th>Producto</th>
            <th>Stock actual</th>
            <th>Precio de Compra</th> 
            <th>Precio de venta</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
            <th>Ver más</th>
          </tr>
        </thead>
        <tbody id="cuerpo">
         @foreach($inventario as $i)
          <tr>            
            <td>{{$i->codigo}}</td>
            <td>{{$i->nombre}}</td>
            <td>{{$i->stock_actual}}</td>
            <td>{{$i->precio_compra}}</td>
            <td>{{$i->precio_venta }}</td>
            <td><a href="{{"/viewActualizarInventario/$i->invid"}}" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
            <td><a href="{{"/eliminarInventario/$i->invid"}}" class="btn btn-danger"><i class="fas fa-times-circle"></i></a></td>
            <td><a href="#" class="btn btn-success"><i class="far fa-eye"></i></a></td>
          </tr>
         @endforeach
        </tbody>
      </table>
      <div id="error" class="text-center"></div>
      <br>
      {{ $inventario->render()  }}
    </div>
  </div>
@endsection

@section("javascript")
  <script src="js/buscarInventario.js"></script>
@endsection