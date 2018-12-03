@extends("layouts.base")
@section("head")
<style type="text/css">
  #check
  {
    display:inline-block;
    width:19px;
    height:19px;
    background:url(check_radio_sheet.png) left top no-repeat;
  }
</style>
		
@endsection

@section("contenido")
<div class="container" style="padding-top: 20px;">
  <div class="row">
      <div class="col-8 col-lg-offset-2">
  <div class="card">
    <div class="card-header" style="background-color: gray; color: white;">
      Editar categoria
    </div>
    <div class="card-body" >
      <form class="login" method="POST" action="{{ url('/cateeditar/'.$categorias->id) }}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="exampleInputEmail1">Nombre</label>
          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Escribe tu nombre" name="nombre" value="{{$categorias->nombre}}">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Descripcion</label>
          <textarea type="text" class="form-control" id="exampleInputEmail1" placeholder="Escribe la descripcion de la categoria" name="descripcion" >{{$categorias->descripcion}}</textarea>
        </div>
        @if(Session::has("Mensaje"))        
          <div class="alert alert-success" role="alert">
            <strong>{{Session::get("Mensaje")}}</strong>
          </div>
        @endif
        <button type="submit" class="btn btn-primary">Finalizar</button>
        <a href="{{ url('/categorias') }}"><button type="button" class="btn btn-success">Regresar</button></a>
      </form>
    </div>
  </div>
</div>

@endsection