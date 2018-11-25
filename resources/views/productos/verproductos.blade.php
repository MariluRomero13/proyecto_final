@extends('layouts.base')

@section('css')
  <style>
    table tr th{
      text-align: center;
    }

    table tr{
      text-align: center;
    }

    #imagenes{
      width: 295px; 
      margin: 0 auto;
      height: 200px;
    }
    #cards{
      width: 30%; 
      height: 400px; 
      margin: 10px auto; 
      margin-left: 20px;
      float: left; 
      padding-top: 5px;
    }
    #footerbuttons{
      width: 49%; 
      margin: 1% auto;
    }
  </style>
@endsection

@section('contenido')

<div id="contenido" style="margin-top: -15px;">
  <div id="MiniMenu" class="row">
    <div class="col-xs-6 col-md-6 well">
      <a href="{{ url('viewregistrarproductos') }}"><button type="button" class="btn btn-block btn-success">Agregar Productos</button>  </a>   
    </div>

    <div class="col-xs-6 col-md-6 well">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2">
        <div class="input-group-append">
          <button class="btn btn-secondary" type="button" id="button-addon2">Buscar</button>
        </div>
      </div>
    </div>
  </div>

<div class="container">
  @foreach($product as $pro)
    <div class="card" id="cards">
      <img class="card-img-top" src="/imagenes/imagenes_productos/{{$pro->imagen}}" alt="Producto" id="imagenes">
      <div class="card-body">
        <h5 class="card-title">{{$pro->nombre}}</h5>
        <p class="card-text">{{$pro->descripcion}}</p>
      </div>
      <div class="card-footer">
        <button class="btn btn-warning" id="footerbuttons"> <a href="seleccionarproducto/{{$pro->id}}"> Actualizar </button>
        <button class="btn btn-danger" id="footerbuttons"> <a href="eliminar/{{$pro->id}}"> Eliminar </button></a>
      </div>
    </div>
  @endforeach
</div>


</div>
@endsection

@section('javascript')
@endsection