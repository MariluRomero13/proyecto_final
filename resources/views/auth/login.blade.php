<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="shortcut icon" href="imagenes/icono.png">
</head>
<body style="background-color: #d2d6de">

<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5" style="margin-top: 30% !important;">
          <div class="card-body">
            <img class="img-fluid rounded mx-auto d-block" src="imagenes/logo.png" alt="MRCJ Logo" style="width: 200px; margin-bottom: 5%;">
            <form class="form-signin" method="POST" action="{{ url('iniciarsesion') }}">
            	{{ csrf_field() }}
		        <div class="form-group">
		           <label for="usuario">Usuario</label>
		           <input type="text" id="usuario" class="form-control" name="usuario" placeholder="Ingrese su usuario" required autofocus value="{{ old('usuario') }}">
		        </div>

		        <div class="form-group">
		           <label for="clave">Contraseña</label>
		           <input type="password" id="clave" name="clave" class="form-control" placeholder="Ingrese su contraseña" required>
		        </div>

		        <div class="form-group">
		        	<button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
		        </div>
            </form>

            @if ($errors->any())
	          @foreach ($errors->all() as $error)
	            <div class="alert alert-warning">
	              <strong>{{ $error }}</strong>
	            </div>
	          @endforeach
	        @endif

	        @if (Session::has("mensaje"))
	          <div class="alert alert-danger">
	              <strong>{{Session::get("mensaje")}}</strong>
	          </div>
	        @endif
          </div>
        </div>
      </div>
    </div>
 </div>
	


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>