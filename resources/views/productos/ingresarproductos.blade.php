@extends('layouts.base')

@section('css')
  <style>
    #footerbuttons{
      width: 49%; 
      margin: 1% auto;
    }
  </style>
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
          
        <form action="{{url('/registrarproducto')}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
        <div class="form-group">
          <label for="CodigoInput">Codigo</label>
          <input name="id" type="text" class="form-control" id="" placeholder="Ingrese el Codigo">
        </div>

        <div class="form-group">
          <label for="CategoriaSelect">Categoria</label>
          <select name="categoria" class="form-control">
            <option value="1" selected="selected">Eliga La Categoria</option>
            @foreach($cat as $categoria)
            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="NombreInput">Nombre</label>
          <input name="nombre" type="text" class="form-control" id="" placeholder="Ingrese el nombre">
        </div>
        <div class="form-group">
          <label for="DescriptcionInput">Descripcion</label>
          <input name="descripcion" type="text" class="form-control" id="" placeholder="Ingrese su descripcion">
        </div>
        <div class="form-group">
          <label for="ImagenInput">Imagen</label>
          <input name="imagen" type="file" class="form-control" id="" placeholder="Ingrese la Imagen">
        </div>
              <button type="reset" class="btn btn-primary" id="footerbuttons">Limpiar</button>
              <button type="submit" class="btn btn-primary" id="footerbuttons">Registrar</button>
        </div>
      </div>
      
    </div>
  </div>
</form>

@endsection