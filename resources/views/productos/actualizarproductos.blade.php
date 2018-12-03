<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta http-equiv="Expires" content="0" />
    <meta http-equiv="Pragma" content="no-cache" />
  <title>Sistema de ventas MRCJ</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="shortcut icon" href="/imagenes/icono.png">
    <link rel="stylesheet" href="{{"/css/styles.css"}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
 
    @yield('css')
</head>
<body>
  

    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img class="img-fluid rounded mx-auto d-block" src="/imagenes/logo.png" alt="MRCJ Logo" style="width: 100px; margin-bottom: 5%;">
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="{{ url('inicio') }}" id="inicio">Inicio</a>
                    <a href="#categorias" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Categorías</a>
                    <ul class="collapse list-unstyled" id="categorias">
                        <li>
                            <a href="#">Crear</a>
                        </li>
                        <li>
                            <a href="#">Mostrar</a>
                        </li>
                    </ul>

                    <a href="#productos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Productos</a>
                    <ul class="collapse list-unstyled" id="productos">
                        <li>
                            <a href="{{ url('viewregistrarproductos') }}">Crear</a>
                        </li>
                        <li>
                            <a href="{{ url('viewproductos') }}">Mostrar</a>
                        </li>
                    </ul>
                    <a href="#inventario" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Inventario</a>
                    <ul class="collapse list-unstyled" id="inventario">
                        <li>
                            <a href="{{url('viewRegistrarInventario')}}">Crear</a>
                        </li>
                        <li>
                            <a href="{{url('viewMostrarInventario')}}">Mostrar</a>
                        </li>
                    </ul>
                     <a href="#ventas" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Ventas</a>
                    <ul class="collapse list-unstyled" id="ventas">
                        <li>
                            <a href="#">Crear</a>
                        </li>
                        <li>
                            <a href="#">Mostrar</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn" style="background-color: #fff !important">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

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
                </div>
            </nav>
            
            <div class="row justify-content-md-center">
              <div class="col-6">
                <div class="card">
                  <div class="card-header text-white bg-dark mb-3">Actualizar Producto</div>
                    <div class="card-body">
                      @foreach ($consulta as $c)
                        <form action="{{ url("/actualizarproducto/$c->prodid") }}" method="POST" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <div class="form-group text-center">
                            <img src="{{"/imagenes/imagenes_productos/$c->imagen"}}" alt="Producto" id="imagenes" style="width: 18rem;">
                          </div>
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
                            <label for="nombre">Nombre</label>
                            <input value="{{$c->nombre}}" name="nombre" type="text" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" id="formGroupExampleInput2" placeholder="Ingrese el nombre del producto">

                            @if ($errors->has('nombre'))
                              <span class="invalid-feedback">
                                <strong>{{ $errors->first('nombre') }}</strong>
                              </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input value="{{$c->descripcion}}" name="descripcion" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Ingrese la descripción del producto">
                          </div>
                          <div class="form-group">
                            <label for="exampleFormControlFile1">Imagén seleccionada {{ $c->imagen }}</label><br>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="imagen">
                          </div>
                          <button type="submit" class="btn btn-success btn-block">Modificar</button>
                        </form>
                    @endforeach
                  </div>
                </div>      
              </div>
            </div>
        </div>
    </div>
    <script
    src="https://code.jquery.com/jquery-3.3.1.js"
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
</body>
</html>
