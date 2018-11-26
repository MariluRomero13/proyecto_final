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
    <div class="col-6">
      <div class="card">
      <div class="card-header">
        Registrar Producto
      </div>
      <div class="card-body">
         @if($errors->any())
          <div class="alert alert-info animated bounceInUp" role="alert">
            <strong> Tenemos los siguientes errores </strong>
            @foreach($errors->all() as $error)
            <ul>
              <li>{{$error}}</li>
            </ul>
            @endforeach
          </div>
          @endif
          
        <form action="{{url('/registrarproducto')}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
        <div class="form-group">
          <label for="CodigoInput">Código</label>
          <input name="id" type="text" class="form-control" id="" placeholder="Ingrese un código">
        </div>

        <div class="form-group">
          <label for="CategoriaSelect">Categoría</label>
          <select name="categoria" class="form-control">
            <option selected="selected">Selecciona una categoría</option>
            @foreach($cat as $categoria)
              <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="NombreInput">Nombre</label>
          <input name="nombre" type="text" class="form-control" id="" placeholder="Ingrese un nombre">
        </div>
        <div class="form-group">
          <label for="DescriptcionInput">Descripcion</label>
          <input name="descripcion" type="text" class="form-control" id="" placeholder="Ingrese una descripción">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupFileAddon01">Subir</span>
          </div>
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="imagen" aria-describedby="inputGroupFileAddon01">
            <label class="custom-file-label" for="inputGroupFile01">Selecciona una imágen</label>
          </div>
        </div>
            <button type="reset" class="btn btn-primary" id="footerbuttons">Limpiar</button>
            <button type="submit" class="btn btn-success" id="footerbuttons">Registrar</button>
        </div>
      </div>
      
    </div>
  </div>
</form>

@endsection