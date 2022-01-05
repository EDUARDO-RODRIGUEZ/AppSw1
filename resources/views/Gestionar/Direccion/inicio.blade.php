@extends('layout.plantilla')
@section('contenido')

  <div class="card">
  <div class="card-header"><h3 >Lista de direcciones</h3>
    

  </div>

  <!-- /.card-header -->
  <div class="card-body p-0">
    <div class="row px-4 py-2">
    <div class="col"><a  href="{{url('/direccion/formulario')}}"  class="btn btn-outline-success "><i class="fas fa-plus-circle"></i>  Registrar</a></div>
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
          	 <!-- /.Modal para eliminar -->
				<div class="modal fade" id="eliminar{{$direccion->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">categoria
				        <h5 class="modal-title" id="staticBackdropLabel">Eliminar categoria {{$direccion->nombre}}</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        ¿ Esta seguro ?, no se revertirán los cambios.
				      </div>
				      <div class="modal-footer">
                  <form method="POST" action="{{url('/direccion/eliminar/'. $direccion->id)}}">
                  @csrf
                  @method('DELETE')
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn btn-danger">Si,eliminar.</button>
                </form>
				      </div>
				    </div>
				  </div>
				</div>

          	<tr>

				<th>{{$direccion->id}}</th>
				<td>{{$direccion->nombre}}</td>
				<td>{{$direccion->referencia}}</td>
        <td>{{$direccion->calle}}</td>
        <td class="p-3" ><div class="p-3" id="map{{$loop->iteration}}" data-latitud="{{ $direccion->latitud}}"  data-longuitud="{{ $direccion->longitud }}"  style="width: auto;height: 200px;"></div></td>
				<td> 
					<a class="mr-3" href="{{url('/direccion/devolverDatos/'.$direccion->id)}}" data-id="1" style="background: #F4F7F9;color: #0353FF;   -webkit-border-radius: 50px;
					  -moz-border-radius: 50px;" class=""><i class="fas fa-user-edit fa-sm"></i></a>
					<a class="mr-3" href data-toggle="modal" data-target="#eliminar{{$direccion->id}}" data-id="1" style="background: #FFFFFF;color: #0353FF;background: #F4F7F9;   -webkit-border-radius: 50px;
					  -moz-border-radius: 50px;"><i  class="fas fa-trash-alt fa-sm"></i></a>

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