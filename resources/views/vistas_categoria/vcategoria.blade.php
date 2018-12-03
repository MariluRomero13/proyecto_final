@extends("layouts.base")

@section("head")
<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
@endsection

@section("contenido")
<div class="row">
  @foreach($categorias as $cate)
     <div class="col-md-4">
         <div class="card mb-4 text-white bg-dark">
            <div class="card-body">
               <h5 class="card-title">{{$cate->nombre}}</h5>
               <p class="card-text" style="color: white;">{{$cate->descripcion}}</p>
               <a href="{{url('/cateeditar/'.$cate->id)}}" class="btn btn-block btn-outline-primary btn-sm">Editar</a>
               <div class="dropdown" style="margin-top: 5px;">
	               	<a href="" class="btn btn-block btn-outline-success btn-sm dropdown-toggle" id="dropdown1" data-toggle="dropdown">Ver productos</a>
			        <div class="dropdown-menu">
			          <div class="dropdown-header">Lista de productos</div>
				        <ul>
                @foreach($cate->productos as $prod)
				          <li>{{$prod->nombre}}</li>
                @endforeach
				      	</ul>
  			        </div>
        			</div>  
            </div>
          </div>
      </div>
  @endforeach
</div>
@endsection