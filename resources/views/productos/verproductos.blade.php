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
    <label class="sr-only" for="inlineFormInputGroupUsername2">Buscar</label>
      <div class="input-group mb-2 mr-sm-2">
        @csrf
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fa fa-search"></i></div>
        </div>
        <input type="text" class="form-control" id="buscador" placeholder="Buscar...">
      </div>
  </div>
</div>
<br>
<div class="container-fluid" id="ContenidoCartas">
  <div class="row justify-content-center" id="cuerpo">
      @foreach($productos as $pro)
        <div class="card" style="width: 17rem; margin-left: 2%;" >

          <img class="card-img-top" src="storage/ImgProductos/{{$pro->imagen}}" alt="Card image cap" class="img-fluid" style="width: 16.8rem; height: 17rem;">

          <div class="card-body">
            <h5 class="card-title">{{$pro->codigo }} - {{ $pro->nombre }}</h5>
          </div>
          <div class="card-footer">
            <a href="{{ url("/seleccionarproducto/$pro->id") }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
            <a href="{{ url("/eliminar/$pro->id") }}" class="btn btn-danger"><i class="fas fa-times-circle"></i></a>
            <a href="{{ url("vermasproductos/$pro->id") }}" class="btn btn-success"><i class="far fa-eye"></i></a>
          </div>
      </div>
      @endforeach
      <div id="error"></div>
  </div>
  <br>
  {{ $productos->render()  }}
</div>
@endsection

@section("javascript")
<script src="js/buscar.js"></script>
  
@endsection





