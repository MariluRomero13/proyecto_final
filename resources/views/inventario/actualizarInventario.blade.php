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
      <div class="card-header">
        Actualizar Inventario
      </div>
      @foreach($inventario as $i)
      <div class="card-body">
        <form action="{{url("/actualizarInventario/$i->inventarioid")}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <input name="producto" type="text" class="form-control" id="" placeholder="Ingrese cantidad de stock inicial" value="{{$i->nombre}}" disabled>
          </div>
          <div class="form-group">
            <label for="stock_a">Stock actual</label>
            <input name="stock_a" type="text" class="form-control" id="" placeholder="Ingrese cantidad de stock inicial" value="{{$i->stock_actual}}" disabled>
          </div>
          <div class="form-group">
            <label for="stock_n">Stock nuevo</label>
            <input name="stock_n" type="text" class="form-control" id="" placeholder="Ingrese cantidad de stock inicial" value="{{0}}">
          </div>
          <div class="form-group">
            <label for="precio_v">Precio de venta</label>
            <input name="precio_v" type="text" class="form-control" id="" placeholder="Ingrese el precio de venta" value="{{$i->precio_venta}}">
          </div>
          <div class="form-group">
            <label for="precio_c">Precio de compra</label>
            <input name="precio_c" type="text" class="form-control" id="" placeholder="Ingrese el precio de compra" value="{{$i->precio_compra}}">
          </div>
          <div class="form-group">
            <label for="fecha_a">Fecha de adquisicion</label>
            <input name="fecha_a" type="date" class="form-control" id="" placeholder="" value="{{$i->fecha_adquisicion}}">
          </div>
          @endforeach
         
          <button type="reset" class="btn btn-primary" id="footerbuttons">Limpiar</button>
          <button type="submit" class="btn btn-success" id="footerbuttons">Registrar</button>
          </form>
        </div>
      </div>
      
    </div>
  </div>
  


@endsection