@extends('layout.plantilla')
@section('contenido') 
  <div class="row">
  @forelse($Categorias as $categoria)
  <div class="col-4">
    <div class="card" style="width: 22rem;">
      <div class="card-header" style="background-color: {{ $categoria->color }};"></div>
      <div class="text-center pt-4">  <img  src="{{ '/storage/productos/'.$categoria->imagen }}"  style="width: 150px; height:150px;"class="card-img-top bg-danger text-center rounded-circle" alt="..."></div>
  <hr>
    <div class="card-body">
    <h3 ><a href="#" class="card-link">{{$categoria->nombre}}</a></h3>
    <p class="card-text">{!! htmlspecialchars_decode( $categoria->descripcion)!!}</p>
    </div>
    <ul class="list-group list-group-flush">
    <li class="list-group-item">Cras justo odio</li>
    <li class="list-group-item">Dapibus ac facilisis in</li>
    <li class="list-group-item">Vestibulum at eros</li>
    </ul>

    </div>
  </div>
  @empty

  @endforelse
  </div>
@endsection
@push('scripts')
  <script type="text/javascript" >


  </script>
@endpush