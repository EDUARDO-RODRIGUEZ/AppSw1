@extends('layout.plantilla')
@section('contenido')

  <div class="card">
  <div class="card-header"><h3 >Lista de empresas</h3>
    

  </div>

  <!-- /.card-header -->
  <div class="card-body p-0">



    <div class="row px-4 py-2">
    <div class="col"><a  href="{{url('/empresa/formulario')}}"  class="btn btn-outline-success "><i class="fas fa-plus-circle"></i>  Registrar</a></div>
    <div class="justify-content-end">
    <form class="form-group" method ="get" action="{{url('/empresa/listar')}}">
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
          <th  width="20">Logotipo</th>
          <th width="10">Nombre</th>
          <th  width="20">Descripción</th>
          <th width="20">Comisión</th>
          <th width="20">Total comisión</th>
          <th  width="20">Representante</th>
          <th width="10">Telefono</th>
          <th width="20">Direccion</th>
          <th width="30">Cobrar</th>
          <th width="40">Acción</th>
        </tr>
      </thead>
      <tbody>
          @foreach($empresas as $empresa)

        <!-- /.Modal para eliminar -->
        <div class="modal fade" id="eliminar{{$empresa->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">categoria
                <h5 class="modal-title" id="staticBackdropLabel">Eliminar categoria {{$empresa->nombre}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                ¿ Esta seguro ?, no se revertirán los cambios.
              </div>
              <div class="modal-footer">
                  <form method="POST" action="{{url('/empresa/eliminar/'. $empresa->id)}}">
                  @csrf
                  @method('DELETE')
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger">Si,eliminar.</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- /.Modal para realizar cobro -->
        <div class="modal fade" id="cobrar{{$empresa->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Realizar cobro a {{$empresa->nombre}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                ¿ Esta segurode realizar el cobro?, no se revertirán los cambios.
                <form method="POST" action="{{url('/realizarCobro/'. $empresa->id)}}">
                  @csrf
                  <div class="row">
                    <div class="col-5 "><label >Total comision:</label> <h3><span class="badge badge-secondary">{{$empresa->totalcomision}}</span></h3></div>
                    <div class="col-7"><div class="form-group ">
                  <label >Cobrar total de la comision :</label>
                  <input name="monto" value="{{ old('monto') }}" type="text" class="form-control">
                  </div></div>
                    
                  </div>
                  
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-secondary">Cobrar monto</button>
                </form>
              </div>
              <div class="modal-footer">
                  
              </div>
            </div>
          </div>
        </div>


        <tr>

        <th>{{$empresa->id}}</th>
        <th><img src="{{ '/storage/empresas/'.$empresa->imagen }}" class="img-thumbnail img-lg" style="width: 60px; height:60px;"></th>
        <td>{{$empresa->nombre}}</td>
        <td>{{$empresa->descripcion}}</td>
        <td>{{$empresa->comision}}</td>
        <td>{{$empresa->totalcomision}}</td>
        <td>{{$empresa->representante}}</td>
        <td>{{$empresa->telefono}}</td>
        <td>{{$empresa->direccion}}</td>
        <td><a class="btn btn-primary w-100" href data-toggle="modal" data-target="#cobrar{{$empresa->id}}"  >COBRAR</a></td>
        <td> 
        <a class="mr-3" href="{{url('/empresa/devolverDatos/'.$empresa->id)}}" data-id="1" style="background: #F4F7F9;color: #0353FF;   -webkit-border-radius: 50px;
        -moz-border-radius: 50px;" class=""><i class="fas fa-user-edit fa-sm"></i></a>
        <a class="mr-3" href data-toggle="modal" data-target="#eliminar{{$empresa->id}}" data-id="1" style="background: #FFFFFF;color: #0353FF;background: #F4F7F9;   -webkit-border-radius: 50px;
        -moz-border-radius: 50px;"><i  class="fas fa-trash-alt fa-sm"></i></a>
        

        </td>
        </tr>
          	
          @endforeach
      </tbody>
    </table>
  </div>
 
</div>




@endsection
@push('scripts')
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@9') }}"></script>
	<script type="text/javascript" >


	</script>
@endpush