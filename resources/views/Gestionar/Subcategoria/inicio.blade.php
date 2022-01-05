@extends('layout.plantilla')
@section('contenido')

  <div class="card">
  <div class="card-header">
    <h3 >Lista de subcategorias</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">

    <div class="row px-4 py-2">
    <div class="col"><a  href="{{url('/subcategoria/formulario')}}"  class="btn btn-outline-success ">
      <i class="fas fa-plus-circle"></i>  Registrar</a>
    </div>
    <div class="justify-content-end">
    <form class="form-group" method ="get" action="{{url('/subcategoria/listar')}}">
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
          <th width="10">Nombre</th>
          <th  width="20">Descripción</th>
          <th width="20">Categoria</th>
          <th width="20">Imagen</th>
          <th width="20">Color</th>
          <th width="40">Acción</th>
        </tr>
      </thead>
      <tbody>
          @foreach($Subcategorias as $subcategoria)
          	 <!-- /.Modal para eliminar -->
				<div class="modal fade" id="eliminar{{$subcategoria->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="staticBackdropLabel">Eliminar subcategoria {{$subcategoria->nombre}}</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        ¿ Esta seguro ?, no se revertirán los cambios.
				      </div>
				      <div class="modal-footer">
				        <form method="POST" action="{{url('/subcategoria/eliminar/'. $subcategoria->id)}}">
                  @csrf
                  @method('DELETE')
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger">Si,eliminar.</button>
                </form>
				      </div>
				    </div>
				  </div>
				</div>
<!-- /.Final del Modal para eliminar -->
          	<tr>

				<th>{{$subcategoria->id}}</th>
				<td>{{$subcategoria->nombre}}</td>
				<td>{!! htmlspecialchars_decode( $subcategoria->descripcion)!!}</td>
        <th>{{$subcategoria->categoria->nombre}}</th>
				<td><img src="{{ '/storage/productos/'.$subcategoria->imagen }}" class="img-thumbnail img-lg" style="width: 60px; height:60px;"></div></td>
        <th><div class="" style="width:50px; height: 50px;  background-color:{{$subcategoria->color}};">  </div></th>

				<td> 
					<a class="mr-3" href="{{url('/subcategoria/devolverDatos/'.$subcategoria->id)}}" data-id="1" style="background: #F4F7F9;color: #0353FF;   -webkit-border-radius: 50px;
					  -moz-border-radius: 50px;" class=""><i class="fas fa-user-edit fa-sm"></i></a>
					<a class="mr-3" href data-toggle="modal" data-target="#eliminar{{$subcategoria->id}}" data-id="1" style="background: #FFFFFF;color: #0353FF;background: #F4F7F9;   -webkit-border-radius: 50px;
					  -moz-border-radius: 50px;"><i  class="fas fa-trash-alt fa-sm"></i></a>
					<a class="mr-3" href="{{ url('/subcategoria/ver/'.$subcategoria->id)}}" data-id="1" style="background: #F4F7F9;   -webkit-border-radius: 50px;
					  -moz-border-radius: 50px;
					  border-radius: 50px; color: #0353FF;" class=""><i class="fas fa-eye fa-sm"></i></a>

				</td>
          	</tr>
          	
          @endforeach
      </tbody>
    </table>
{{ $Subcategorias->links() }}
  </div>
 
</div>



@endsection
@push('scripts')
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@9') }}"></script>
	<script type="text/javascript" >


	</script>
@endpush