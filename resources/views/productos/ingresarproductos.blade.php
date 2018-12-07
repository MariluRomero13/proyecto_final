@extends('layouts.base')

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
  <div class="row justify-content-center">
    <div class="col-10 col-xl-8 col-lg-8">
        <div class="card">
          <div class="card-header text-white bg-dark mb-3">Registrar productos</div>
          <div class="card-body">
            <form action="{{url('/registrarproducto')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="CodigoInput">Código</label>
                    <input name="codigo" type="number" class="form-control {{ $errors->has('codigo') ? ' is-invalid' : '' }}" placeholder="Ingrese un código" required value="{{ old('codigo') }}">
                    @if ($errors->has('codigo'))
                        <span class="invalid-feedback">
                          <strong>{{ $errors->first('codigo') }}</strong>
                        </span>
                    @endif

                  </div>
                  <div class="form-group col-md-6">
                    <label for="NombreInput">Nombre</label>
                    <input name="nombre" type="text" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}"  placeholder="Ingrese un nombre"  value="{{ old('nombre') }}">
                      @if ($errors->has('nombre'))
                        <span class="invalid-feedback">
                          <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                      @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="CategoriaSelect">Categoría</label>
                  <select name="categoria" class="form-control" required>
                    <option selected="{{ old('categoria') }}" value="">Selecciona una categoría</option>
                    @foreach($cat as $categoria)
                      <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endforeach
                  </select>
                </div>

                
                <div class="form-group">
                  <label for="descripcion">Descripción</label>
                  <input class="form-control" name="descripcion" rows="3" value="{{ old('descripcion') }}">
                </div>
                
                <div class="form-group">
                  <label for="exampleFormControlFile1">Selecciona una imágen</label>
                  <input type="file" class="form-control-file {{ $errors->has('imagen') ? ' is-invalid' : '' }}" id="exampleFormControlFile1" name="imagen" value="{{ old('imagen') }}">
                  @if ($errors->has('imagen'))
                    <span class="invalid-feedback">
                      <strong>{{ $errors->first('imagen') }}</strong>
                    </span>
                  @endif
                </div>
                <button type="reset" class="btn btn-primary"><i class="fas fa-trash-alt"></i></button>
                <button type="submit" class="btn btn-success">Registrar</button> 
              </form>
              
              <br>
          </div>
        </div>
    </div>
  </div>
@endsection




 
