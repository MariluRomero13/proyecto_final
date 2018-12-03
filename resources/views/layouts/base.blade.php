<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="shortcut icon" href="imagenes/icono.png">
    <link rel="stylesheet" href="css/styles.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    @yield('head')
</head>
<body>
	

    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img class="img-fluid rounded mx-auto d-block" src="imagenes/logo.png" alt="MRCJ Logo" style="width: 100px; margin-bottom: 5%;">
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="#" id="inicio">Inicio</a>
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
                            <a href="#">Crear</a>
                        </li>
                        <li>
                            <a href="#">Mostrar</a>
                        </li>
                    </ul>
                    <a href="#inventario" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Inventario</a>
                    <ul class="collapse list-unstyled" id="inventario">
                        <li>
                            <a href="#">Crear</a>
                        </li>
                        <li>
                            <a href="#">Mostrar</a>
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

                    @yield('menu')
                </div>
            </nav>
            
            @yield('contenido')
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

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