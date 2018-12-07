@extends("layouts.base")

@section("css")
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
@endsection

@section("contenido")

<div class="container-fluid" id="ContenidoCartas">
  <br>
  <div class="row justify-content-center" id="cuerpo">
      @foreach($categorias as $cate)
        <div class="card text-white bg-dark" style="width: 20rem; margin-left: 2%;" >
          <div class="card-body">
            <h5 class="card-title">{{$cate->nombre}}</h5>
            <p class="card-text text-white">{{$cate->descripcion}}</p>
            <div class="text-center"><a href="{{ url("/catalogo/$cate->id") }}" class="btn btn-success">Catálogo de productos</a></div>
          </div>

          <div class="card-footer">
            <a href="{{ url("/cateeditar/$cate->id") }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
            <a href="{{ url("/cateliminar/$cate->id") }}" class="btn btn-danger"><i class="fas fa-times-circle"></i></a>
          </div>
      </div>
      @endforeach
  </div>
  <br>
  {{ $categorias->render()  }}
</div>
@endsection