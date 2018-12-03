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
      <div class="card-header text-white bg-dark mb-3">
        Registrar Inventario
      </div>
      <div class="card-body">
        <form action="{{url('/altaInventario')}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="idproducto">Producto</label>
            <select name="idproducto" class="form-control {{ $errors->has('idproducto') ? ' is-invalid' : '' }}">
              <option selected="selected" value="">Selecciona un producto</option>
              @foreach($productos as $p)
                <option value="{{$p->id}}">{{ $p->id }} {{$p->nombre}}</option>
              @endforeach
            </select>
            @if ($errors->has('idproducto'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('idproducto') }}</strong>
                </span>
            @endif
        </div>
          <div class="form-group">
            <label for="stock_a">Stock</label>
            <input name="stock_a" type="text" class="form-control {{ $errors->has('stock_a') ? ' is-invalid' : '' }}" id="" placeholder="Ingrese cantidad de stock inicial" required value="{{ old('stock_a') }}">
            @if ($errors->has('stock_a'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('stock_a') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="precio_c">Precio de compra</label>
              <input name="precio_c" type="text" class="form-control {{ $errors->has('precio_c') ? ' is-invalid' : '' }}" id="" placeholder="Ingrese el precio de compra" required value="{{ old('precio_c') }}">
              @if ($errors->has('precio_c'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('precio_c') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group col-md-6">
              <label for="precio_v">Precio de venta</label>
              <input name="precio_v" type="text" class="form-control {{ $errors->has('stock_a') ? ' is-invalid' : '' }}" id="" placeholder="Ingrese el precio de venta" required value="{{ old('precio_v') }}">
              @if ($errors->has('precio_v'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('precio_v') }}</strong>
                </span>
              @endif
            </div>
          </div>
          <button type="reset" class="btn btn-primary"><i class="fas fa-trash-alt"></i></button>
          <button type="submit" class="btn btn-success">Registrar</button> 
          </form>
          @if(Session::has("mensaje"))
            <br>
            <div class="alert alert-info animated bounceInUp" role="alert">
              <strong>{{Session::get("mensaje")}}</strong>
            </div>
          @endif
        </div>
      </div>
      
    </div>
  </div>


@endsection