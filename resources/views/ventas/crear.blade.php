@extends("layouts.base")

@section("css")
<link rel="stylesheet" href="css/estilos.css">
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

<div id="miModal" class="modal">
	<div class="flex" id="flex">
		<div class="contenido-modal">
			<div class="modal-header flex">
				<span class="close" id="close">&times;</span>
			</div>
			<div class="modal-body">
				<p class="text-center cancelar font-weight-normal">¿Estás seguro de cancelar?</p>			
			</div>
			<div class="footer text-right">
				<button class="btn btn-success" id="si">Si</button>
				<button class="btn btn-danger" id="no">No</button>
			</div>
		</div>
	</div>
</div>


<div class="row justify-content-md-center">
    <div class="col-10">
      <div class="card">
      <div class="card-header text-white bg-dark mb-3">
        Registrar Venta
      </div>
      <div class="card-body">
          {{ csrf_field() }}
          	<div class="form-row">
	          	<div class="form-group col-md-4">
	              <label for="codigo">Código</label>
	              <input id="codigo" type="number" class="form-control">
	            </div>
	        	<div class="form-group col-md-4">
	              <label for="producto">Producto</label>
	              <input id="producto" type="text" class="form-control" disabled>
	            </div>
	            <div class="form-group col-md-4">
	              <label for="precio_v">Precio</label>
	              <input id="precio_v" type="text" class="form-control" disabled>
	            </div>
        	</div>
        	<div class="form-row">
        		
		        <div class="form-group col-md-4">
		            <label for="stock_a">Stock</label>
		            <input id="stock_a" type="text" class="form-control" disabled>
		        </div>
		        <div class="form-group col-md-4">
		            <label for="cantidad">Cantidad</label>
		            <input  type="number" class="form-control " id="cantidad" placeholder="Ingrese la cantidad">
		        </div>
		        <div class="form-group col-md-4">
		            <label for="efectivo">Efectivo</label>
		            <input  type="number" class="form-control " id="efectivo" placeholder="Ingrese el efectivo">
		            <label for="cambio" id="cambio">Cambio $0.0</label>
		        </div>
	    	</div>
	      	<button type="reset" class="btn btn-primary" id="limpiar"><i class="fas fa-trash-alt"></i></button>
          	<button type="button" class="btn btn-info" id="agregar" diasable>Agregar</button><br><br>
          	
          	<br>
          	<form action="{{ url('registrarVenta') }}" method="POST" name="form" target="_blank">
          		{{ csrf_field() }}
          	<div class="col-md-10">
          		<table class="table table-responsive table-responsive-lg table-hover">
			        <thead>
			          <tr>
			            <th>Opciones</th>
			            <th>Articulo</th>
			            <th>Precio</th>
			            <th>Cantidad</th>
			            <th>Subtotal</th>
			          </tr>
			        </thead>
			        <tbody id="cuerpo">
			         	
			        </tbody>
			        <tfoot>
			        	<th>Total</th>
			        	<th></th>
			        	<th></th>
			        	<th></th>
			        	<th></th>
			        	<th><h5 id="total">$ 0.0</h5></th>
			        	<th><input type="hidden" class="form-control" name="total"></th>
			        </tfoot>
		    	</table>
	        </div>
	        <div id="guardar">
	        	<button type="button" class="btn btn-secondary" id="cancelar" diasable>Cerrar</button>
	        	<button type="submit" class="btn btn-success" id="registrar" diasable>Registrar</button>
	        </div>
          	</form>
          
         	<div id="mensaje"></div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section("javascript")
	<script src="js/ventas.js"></script>
	<script src="js/main.js"></script>
@endsection

