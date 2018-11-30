@extends('layouts.base')


@section('css')
  <style>

    #cards{
      width: 390px; 
      height: 450px; 
      margin: 13px;
      padding: 5px;
      float: left; 
    }

    #cardbody{
      top: 230px;
      position: relative;
      margin: 10px;
    }

    #imagenes{
      width: 360px; 
      height: 210px;
      position: absolute;
      margin-top: 5px;
    }

    #CardFooter{
      position: absolute;
      bottom:0;
      padding-bottom: 10px;

    }

    #footerbuttons{
      width: 165px; 
      margin: 3px;
      color: white;
    }
    #Lienzo{
      padding-top: 5px;
      margin-top: -30px;
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


<div class="container-fluid" id="Lienzo">
  <div class="row justify-content-center">
      <div class="col-xs-6 col-md-6 col-sm-6 col-xl-6 justify-content-start well">
      <a href="{{ url('viewregistrarproductos') }}"><button type="button" class="btn btn-block btn-success">  Agregar Productos</button>  </a>   
      </div>

      <div class="col-xs-6 col-md-6 col-sm-6 col-xl-6 justify-content-start well">
        <div class="input-group">
        <input type="text" class="form-control" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2">
          <div class="input-group-append">
            <button class="btn btn-secondary" type="button" id="button-addon2">Buscar</button>
          </div>
        </div>
      </div>

    </div>


<div class="container-fluid" id="ContenidoCartas">
  <div class="row justify-content-center">
    @foreach($productos as $pro)



    <div class="card" id="cards">
      <img class="card-img-top align-self-center" src="{{"/imagenes/imagenes_productos/$pro->imagen"}}" alt="Producto" id="imagenes">

      <div class="align-self-auto" id="cardbody">
        <h5 class="card-title">{{$pro->nombre}}</h5>
        <p class="card-text">{{$pro->descripcion}}</p>   
      </div>


        <hr>

      <div class="align-self-center" id="CardFooter">
        <a href="{{ url("/seleccionarproducto/$pro->id") }}" class="btn btn-warning" id="footerbuttons">Actualizar</a>
        <a class="btn btn-danger" id="footerbuttons" href="{{ url("/eliminar/$pro->id") }}">Eliminar</a>
      </div>

    </div>



    @endforeach
  </div>
</div>
</div>














@endsection

@section('javascript')
@endsection