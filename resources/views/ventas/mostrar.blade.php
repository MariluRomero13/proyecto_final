@extends('layouts.base')

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
          <input type="number" class="form-control" id="buscador" placeholder="Buscar...">
        </div>
    </div>
  </div>
  <br>
  <div class="row justify-content-md-center">
    <div class="col-12">
      <table class="table table-responsive-lg table-hove" style="background-color: ; color: ;">
        <thead>
          <tr>
            <th>Folio</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Detalles</th>
            <th>Cancelar</th>
          </tr>
        </thead>
        <tbody id="cuerpo">
         @foreach($ventas as $v)
          <tr> 
            <td>{{ $v->id }}</td>           
            <td>{{$v->fecha_venta}}</td>
            <td>{{$v->total}}</td>
            <td><a href="{{ url("/mostrarDetalles/$v->id") }}" class="btn btn-success"><i class="far fa-eye"></i></a></td>
            <td><a href="#" class="btn btn-danger"><i class="fas fa-times-circle"></i></a></td>
          </tr>
         @endforeach
        </tbody>
      </table>
      <div id="error" class="text-center"></div>
      <br>
      {{ $ventas->links()  }}
    </div>
  </div>
@endsection

@section("javascript")
<script src="js/buscarVenta.js"></script>
@endsection

