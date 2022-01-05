@extends('layout.plantilla')
@section('contenido')

  <div class="card">
  <div class="card-header"><h3 >Lista de roles</h3>
    

  </div>

  <!-- /.card-header -->
  <div class="card-body p-0">
    <div class="row px-4 py-2">
    <div class="col"><a  href="{{url('/rol/formulario')}}"  class="btn btn-outline-success "><i class="fas fa-plus-circle"></i>  Nuevo</a></div>
    <div class="justify-content-end">
    <form class="form-group" method ="get" action="{{url('/rol/listar')}}">
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
    <table class="table table-striped">
      <thead>
        <tr>
          <th width="5">Id</th>
          <th width="10">Nombre del rol</th>
          <th  width="20">Descripción</th>
          <th  width="20">Acciones</th>
          <th width="20">Privilegios</th>
          <th width="40">Acción</th>
        </tr>
      </thead>
      <tbody>
          @foreach($roles as $rol)
          	 <!-- /.Modal para eliminar -->
				<div class="modal fade" id="eliminar{{$rol->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="staticBackdropLabel">Eliminar rol {{$rol->nombre}}</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        ¿ Esta seguro ?, no se revertirán los cambios.
				      </div>
				      <div class="modal-footer">
                  <form method="POST" action="{{url('/rol/eliminar/'. $rol->id)}}">
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

				<th>{{$rol->id}}</th>
				<td><strong>{{$rol->nombre}}</strong></td>
        <td>{{$rol->descripcion}}</td>
        <td>
        @foreach($rol->rolacciones as $accion)
            @if($accion->idaccion == 1)
              @if($accion->eliminado == 0)
                <h4> <span class="badge badge-secondary"  data-toggle="tooltip" data-placement="top" title="{{ $accion->accion->descripcion}}">Gestionar producto</span></h4>
              @endif
            @endif
            @if($accion->idaccion == 2)
              @if($accion->eliminado == 0)
                <h4> <span class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="{{ $accion->accion->descripcion}}">Gestionar pedido</span></h4>
              @endif
            @endif
        @endforeach
        </td>
        <td>
        @foreach($rol->rolprivilegioes as $privilegio)
            @if($privilegio->idprivilegio == 1)
              @if($privilegio->eliminado == 0)
                <h4> <span class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="{{ $privilegio->privilegio->descripcion}}">Listar y ver</span></h4>
              @endif
            @endif
            @if($privilegio->idprivilegio == 2)
            @if($privilegio->eliminado == 0)
                <h4> <span class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="{{ $privilegio->privilegio->descripcion}}">Buscar</span></h4>
            @endif
            @endif
            @if($privilegio->idprivilegio == 3)
            @if($privilegio->eliminado == 0)
                <h4> <span class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="{{ $privilegio->privilegio->descripcion}}">Registrar</span></h4>
            @endif
            @endif
            @if($privilegio->idprivilegio == 4)
            @if($privilegio->eliminado == 0)
                <h4> <span class="badge badge-warning" data-toggle="tooltip" data-placement="top" title="{{ $privilegio->privilegio->descripcion}}">Editar</span></h4>
            @endif
            @endif
            @if($privilegio->idprivilegio == 5)
            @if($privilegio->eliminado == 0)
                <h4> <span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="{{ $privilegio->privilegio->descripcion}}">Eliminar</span></h4>
            @endif
            @endif
            @if($privilegio->idprivilegio == 6)
            @if($privilegio->eliminado == 0)
                <h4> <span class="badge badge-success" data-toggle="tooltip" data-placement="top" title="{{ $privilegio->privilegio->descripcion}}">Asignar repartidor</span></h4>
            @endif
            @endif
            @if($privilegio->idprivilegio == 7)
            @if($privilegio->eliminado == 0)
                <h4> <span class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="{{ $privilegio->privilegio->descripcion}}">Cambiar estado</span></h4>
            @endif
            @endif
        @endforeach
        </td>
				<td> 
					<a class="mr-3" href="{{url('/rol/devolverDatos/'.$rol->id)}}" data-id="1" style="background: #F4F7F9;color: #0353FF;   -webkit-border-radius: 50px;
					  -moz-border-radius: 50px;" class=""><i class="fas fa-user-edit fa-sm"></i></a>
					<a class="mr-3" href data-toggle="modal" data-target="#eliminar{{$rol->id}}" data-id="1" style="background: #FFFFFF;color: #0353FF;background: #F4F7F9;   -webkit-border-radius: 50px;
					  -moz-border-radius: 50px;"><i  class="fas fa-trash-alt fa-sm"></i></a>

				</td>
          	</tr>
          	
          @endforeach
      </tbody>
    </table>
{{ $roles->links() }}
  </div>
 
</div>




@endsection
@push('scripts')
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@9') }}"></script>
	<script type="text/javascript" >
      $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

	</script>
@endpush