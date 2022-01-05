@extends('layout.plantilla')
@section('contenido')

  <div class="card">
  <div class="card-header">
    <h3 >Lista de clientes</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
      @if(Session::has('flash_message'))
      <div class="px-2"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> {!! session('flash_message') !!}</div></div>
       
      @endif
    <div class="row px-4 py-2">

    <div class="justify-content-end">

    <form class="form-group" method ="get" action="{{url('/cliente/listar')}}">
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
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Id</th>
          <th >Imagen</th>
          <th >Nombres</th>
          <th >Apellidos</th>
          <th  >Email</th>
          <th >Cel/Telf</th>
          <th >Sexo</th>
          <th>Activar/Desactivar</th>
          <th >Ver</th>
        </tr>
      </thead>
      <tbody>
          @foreach($clientes as $cliente)
          	 <!-- /.Modal para eliminar -->
				
          <!-- /.FIN Modal para eliminar -->
          	<tr>
				<th>{{$cliente->id}}</th>
        <td><img src="{{ '/storage/productos/'.$cliente->imagen }}" class="img-thumbnail img-lg" style="width: 60px; height:60px;"></div></td>
				<td>{{$cliente->nombres}}</td>
        <td >{{$cliente->apellidos}}</td>
				<td>{{ $cliente->email}}</td>
        <th>{{$cliente->telefono}}</th>
        <th>
          @if($cliente->sexo == 1)
            Masculino
          @elseif($cliente->sexo == 2)
            Femenino
          @endif
        </th>
        
        <td>
    				@if($cliente->estado == 1)
    					<a href="{{url('/cliente/'. $cliente->id .'/estado/0')}}" class="btn btn-outline-danger w-100">DESACTIVAR</a> 
    					@elseif($cliente->estado == 0)
    				  <a href="{{url('/cliente/'. $cliente->id .'/estado/1')}}" class="btn btn-outline-success w-100">ACTIVAR</a> 
    				@endif
        </td>
        <td>
					<a class="mr-3" href="{{ url('/cliente/ver/'.$cliente->id)}}" data-id="1" style="background: #F4F7F9;   -webkit-border-radius: 50px;
					  -moz-border-radius: 50px;
					  border-radius: 50px; color: #0353FF;" class=""><i class="fas fa-eye fa-sm"></i></a>
        </td>
          @endforeach
      </tbody>
    </table>

      {{ $clientes->links() }}

  </div>
 
</div>

 

@endsection
@push('scripts')
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@9') }}"></script>
	<script type="text/javascript" >


	</script>
@endpush