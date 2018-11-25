@extends('layouts.base')

@section('css')
  <style>   
    #imagenes
    {
      width: 295px; 
      margin: 0 auto;
      height: 200px;
      margin-left: 30%;
    }

  </style>
@endsection

@section('contenido')

	<div class="row justify-content-md-center">
    <div class="col-6">
      <div class="card">
      <div class="card-header">
        Actualizar Producto
      </div>
      <div class="card-body">
        <form action= "/actualizarproducto/{{$prod->id}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}   

        <img src="/imagenes/imagenes_productos/{{$prod->imagen}}" alt="Producto" id="imagenes">

        <div class="form-group">
          <label for="Categoria_Select">Categoria</label>
          <select name="categoria" class="form-control">
            <option value="{{$prod->id_categoria}}" selected="selected">{{$prod->categorias->nombre}}</option>
            @foreach($cat as $categoria)
            <option value="{{$categoria->id}}">
              {{$categoria->nombre}}
            </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="ApellidoPaternoInput">Nombre</label>
          <input value="{{$prod->nombre}}" name="nombre" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Ingrese su Apellido Paterno">
        </div>
        <div class="form-group">
          <label for="ApellidoMaternoInput">Descripcion</label>
          <input value="{{$prod->descripcion}}" name="descripcion" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Ingrese su apellido Materno">
        </div>
        <div class="form-group">
          <label for="ImagenInput">Imagen {{$prod->imagen}}</label>
          <input name="imagen" type="file" class="form-control" id="" placeholder=""
          value="">
        </div>
              <button type="submit" class="btn btn-primary btn-block">Modificar </button>
          </form>
        </div>
      </div>      
    </div>
  </div>

@endsection