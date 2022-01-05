@extends('layout.plantilla')
@section('contenido')

  <div class="card">
  <div class="card-header"><h3 >Tus direcciones guardadas</h3>


  </div>

  <!-- /.card-header -->
  <div class="card-body p-0">
    <div class="row px-4 py-2">

    <div class="justify-content-end">
    <form class="form-group" method ="get" action="{{url('/direccion/listar')}}">
        <div class="row">
          <div class="mb-3">
          <input type="text" name="nombre" class="form-control">
        </div>
        <div class="mb-3">
          <button  type="submit" class="btn btn-info form-control mb-2"><i class="fas fa-search"></i>  Buscar </button>
          </div>
        </div>
    </form>
    </div>
    </div>
         @if(Session::has('flash_message'))
      <div class="px-2"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> {!! session('flash_message') !!}</div></div>

      @endif
    <table data-cantidad="{{ $direcciones->count()}}" id="cantidad" class="table table-striped">
      <thead>
        <tr>
          <th width="5" style="width: 5%;">Id</th>
          <th width="5"  style="width:10%;">Nombre</th>
          <th  width="20"  style="width: 25%;">Referencia</th>
          <th  width="20"  style="width: 10%;">Calle</th>
          <th width="40"  style="width: 40%;">Vista previa</th>
          <th width="40"  style="width: 10%;">Acción</th>
        </tr>
      </thead>
      <tbody>
          @foreach($direcciones as $direccion)


          	<tr>

				<th>{{$direccion->id}}</th>
				<td>{{$direccion->nombre}}</td>
				<td>{{$direccion->referencia}}</td>
        <td>{{$direccion->calle}}</td>
        <td class="p-3" ><div class="p-3" id="map{{$loop->iteration}}" data-latitud="{{ $direccion->latitud}}"  data-longuitud="{{ $direccion->longitud }}"  style="width: auto;height: 200px;"></div></td>
				<td>

					<a class="mr-3 btn btn-success" href="{{url('/asignarDireccion/asignar/'.$direccion->id)}}" data-id="1" ><i class="fas fa-user-edit fa-sm"></i>ASIGNAR</a>
				</td>
          	</tr>

          @endforeach
      </tbody>
    </table>
{{ $direcciones->links() }}
  </div>

</div>



@endsection
@push('scripts')
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@9') }}"></script>
	<script type="text/javascript" >
      window.addEventListener("load", function(){
        for(let i = 1 ; i <= document.getElementById('cantidad').getAttribute('data-cantidad')  ; i++){
        var latitud = document.getElementById('map'+i).getAttribute('data-latitud');
        var longuitud = document.getElementById('map'+i).getAttribute('data-longuitud') ;
        console.log(latitud  + longuitud);
  // The location of Uluru
  var uluru = {lat: parseFloat(latitud), lng: parseFloat(longuitud)};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'+i), {zoom: 14, center: uluru});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: uluru, map: map});
      }

      });

	</script>
@endpush