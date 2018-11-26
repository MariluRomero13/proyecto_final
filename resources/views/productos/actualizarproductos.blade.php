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
    <div class="col-6">
      <div class="card">
        <div class="card-header">Actualizar Producto</div>
          @foreach ($consulta as $c)
            <div class="card-body">
              <form action="{{ url('actualizarproducto/$c->id') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <img src="{{"/imagenes/imagenes_productos/$c->imagen"}}" alt="Producto" id="imagenes">
                <div class="form-group">
                  <label for="Categoria_Select">Categoría</label>
                  <select name="categoria" class="form-control">
                    <option value="{{$c->cateid}}" selected="selected">{{$c->catenombre}}</option>
                    @foreach($cat as $categoria)
                      <option value="{{$categoria->id}}">
                        {{$categoria->nombre}}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="ApellidoPaternoInput">Nombre</label>
                  <input value="{{$c->nombre}}" name="nombre" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Ingrese su Apellido Paterno">
                </div>
                <div class="form-group">
                  <label for="ApellidoMaternoInput">Descripcion</label>
                  <input value="{{$c->descripcion}}" name="descripcion" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Ingrese su apellido Materno">
                </div>
                <div class="form-group">
                  <label for="ImagenInput">Imagen {{$c->imagen}}</label>
                  <input name="imagen" type="file" class="form-control" id="" placeholder=""
                  value="">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Modificar</button>
              </form>
            </div>
          @endforeach
      </div>      
    </div>
  </div>
@endsection