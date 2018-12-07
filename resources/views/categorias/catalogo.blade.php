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
                            <a href="{{url('/cateagregar')}}">Crear</a>
                        </li>
                        <li>
                            <a href="{{url('/categorias')}}">Mostrar</a>
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
                            <a href="{{ url('/crearventas') }}">Crear</a>
                        </li>
                        <li>
                            <a href="{{ url('/mostrarventas') }}">Mostrar</a>
                        </li>
                    </ul>
                    <a href="#reportes" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Reportes</a>
                    <ul class="collapse list-unstyled" id="reportes">
                        <li>
                            <a href="#">Reportes</a>
                        </li>
                        <li>
                            <a href="#">Gráficas</a>
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
            
            <div>
              <div class="form-inline">

                <label class="sr-only" for="inlineFormInputGroupUsername2">Buscar</label>
                  <div class="input-group mb-2 mr-sm-2">
                    @csrf
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-search"></i></div>
                    </div>
                    <input type="text" class="form-control" id="buscador" placeholder="Buscar...">
                  </div>
                  <a href="#" class="btn btn-primary" id="volver"  onclick="history.back()" ><i class="fas fa-arrow-left"></i></a>
              </div>
            </div>
            <br>
            <div class="container-fluid" id="ContenidoCartas">
              <div class="row justify-content-center" id="cuerpo">
                  @foreach($categorias as $c)
                    <div class="card" style="width: 17rem; margin-left: 2%;" >
                      <img class="card-img-top" src="{{"/imagenes/imagenes_productos/$c->imagen"}}" alt="Card image cap" class="img-fluid" style="width: 16.5rem; height: 17rem;">
                      <div class="card-body">
                        <h5 class="card-title">{{$c->id }} - {{ $c->nombre }}</h5>
                      </div>
                      <div class="card-footer">
                        <a href="{{ url("/seleccionarproducto/$c->id") }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <a href="{{ url("/eliminar/$c->id") }}" class="btn btn-danger"><i class="fas fa-times-circle"></i></a>
                        <a href="{{ url("vermasproductos/$c->id") }}" class="btn btn-success"><i class="far fa-eye"></i></a>
                      </div>
                  </div>
                  @endforeach
                  <div id="error"></div>
              </div>
              <br>
              {{ $categorias->links() }}
            </div>
        </div>
    </div>
    <script
    src="https://code.jquery.com/jquery-3.3.1.js"
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="/js/buscarProducto.js"></script>

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

