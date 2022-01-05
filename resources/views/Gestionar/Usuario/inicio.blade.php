@extends('layout.plantilla')
@section('contenido')

  <div class="card">
  <div class="card-header">
    <h3 >Lista del personal de las  empresa</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <div class="row px-4 py-2">
    <div class="col"><a  href="{{url('/usuario/formulario')}}"  class="btn btn-outline-success ">
      <i class="fas fa-plus-circle"></i>  Registrar</a>
    </div>
    <div class="justify-content-end">
    <form class="form-group" method ="get" action="{{url('/usuario/listar')}}">
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
          <th>Id</th>
          <th >Imagen</th>
          <th >Nombres</th>
          <th >Apellidos</th>
          <th  >Email</th>
          <th >C.I</th>
          <th >Celular</th>
          <th >Sexo</th>
          <th >Rol del usuario</th>
          <th>Activar/Desactivar</th>
          <th >Acción</th>
        </tr>
      </thead>
      <tbody>
          @foreach($usuarios as $usuario)
          	 <!-- /.Modal para eliminar -->
				<div class="modal fade" id="eliminar{{$usuario->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="staticBackdropLabel">Eliminar usuario {{$usuario->nombre}}</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        ¿ Esta seguro ?, no se revertirán los cambios.
				      </div>
				      <div class="modal-footer">
                <form method="POST" action="{{ url('/usuario/eliminar/'.$usuario->id) }}">
                  @csrf
                  @method('DELETE')
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				        <button type="submit" href class="btn btn-danger">Si,eliminar.</button>
                </form>
				      </div>
				    </div>
				  </div>
				</div>
          <!-- /.FIN Modal para eliminar -->
          	<tr>
				<th>{{$usuario->id}}</th>
        <td><img src="{{ '/storage/images/usuarios/'.$usuario->imagen  }}" class="img-thumbnail img-lg" style="width: 60px; height:60px;"></div></td>
				<td>{{$usuario->name}}</td>
        <td >{{$usuario->apellidos}}</td>
				<td>{{ $usuario->email}}</td>
        <th>{{$usuario->ci}}</th>
        <th>{{$usuario->telefono}}</th>
        <th>
          @if($usuario->sexo == 1)
            Masculino
          @elseif($usuario->sexo == 2)
            Femenino
          @endif
        </th>
            <th><h5><span class="badge badge-secondary">{{$usuario->rol->nombre}}</span></h5></th>
        <td>

          @if($usuario->idrol != 4) 
          @if($usuario->idrol != 1 )
    				@if($usuario->estado == 1)
    					<a href="{{url('/usuario/'. $usuario->id .'/estado/0')}}" class="btn btn-outline-danger">Desactivar</a> 
    					@elseif($usuario->estado == 0)
    				  <a href="{{url('/usuario/'. $usuario->id .'/estado/1')}}" class="btn btn-outline-success">Activar</a> 
    				@endif
          @endif
          @endif

        </td>
        <td>


         @if($usuario->idrol != 4) 
        @if($usuario->idrol != 1)
					<a class="mr-3" href="{{url('/usuario/devolverDatos/'.$usuario->id)}}" data-id="1" style="background: #F4F7F9;color: #0353FF;   -webkit-border-radius: 50px;
					  -moz-border-radius: 50px;" class=""><i class="fas fa-user-edit fa-sm"></i></a>
					<a class="mr-3" href data-toggle="modal" data-target="#eliminar{{$usuario->id}}" data-id="1" style="background: #FFFFFF;color: #0353FF;background: #F4F7F9;   -webkit-border-radius: 50px;
					  -moz-border-radius: 50px;"><i  class="fas fa-trash-alt fa-sm"></i></a>
					<a class="mr-3" href="{{ url('/usuario/ver/'.$usuario->id)}}" data-id="1" style="background: #F4F7F9;   -webkit-border-radius: 50px;
					  -moz-border-radius: 50px;
					  border-radius: 50px; color: #0353FF;" class=""><i class="fas fa-eye fa-sm"></i></a>

        @endif
        @else

        @endif


        </td>

          @endforeach
      </tbody>
    </table>
{{ $usuarios->links() }}
  </div>
 
</div>

 

@endsection
@push('scripts')
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@9') }}"></script>
	<script type="text/javascript" >


	</script>
@endpush