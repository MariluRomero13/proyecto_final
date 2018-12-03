@extends("layouts.base")

@section("head")

@endsection

@section("contenido")
<div class="container" style="padding-top: 20px; float: center;">
  <div class="row col-md-12">
      <div class="col-md-6 " style="margin: 0 auto; float: none; margin-bottom: 10px;">
  <div class="card">
    <div class="card-header" style="background-color: gray; color: white;">
      Agregar una categoria
    </div>
    <div class="card-body" >
      <form action="{{url('/cateagregar')}}" method="POST" role="form">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="">Nombre de la categoría</label>
      <input type="text" class="form-control" placeholder="Escribe el nombre de la categoría" name="nombre">
    </div>

    <div class="form-group">
      <label for="">Descripción</label>
      <textarea type="text" class="form-control" placeholder="Escribe una descripcion de la nueva categoría" name="descripcion"></textarea>
    </div>
    @if(Session::has("Mensaje"))        
      <div class="alert alert-success" role="alert">
        <strong>{{Session::get("Mensaje")}}</strong>
      </div>
    @endif

    <button type="submit" class="btn btn-primary">Agregar</button>
  </form>
    </div>
  </div>
</div>
@endsection