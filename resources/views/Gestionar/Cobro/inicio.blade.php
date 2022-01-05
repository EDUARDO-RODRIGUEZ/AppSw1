@extends('layout.plantilla')
@section('contenido')

  <div class="card">
  <div class="card-header">
    <h3 >Gestionar cobro</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <div class="row px-4 py-2">
    <div class="col">
    </div>
    <div class="justify-content-end">
    <form class="form-group" method ="get" action="{{url('/bitacora/listar')}}">
        <div class="row">
          <div class="mb-3">
          <input type="text" name="id" class="form-control">
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
          <th >Id de usuario</th>
          <th >Id de empresa</th>
          <th >Monto cobrado</th>
          <th >Deuda anterior</th>
          <th  >Deuda actual</th>
          <th  >Fecha del cobro</th>
        </tr>
      </thead>
      <tbody>
          @foreach($cobros as $cobro)
          <tr>
          <th>{{$cobro->id}}</th>
          <td>{{$cobro->idusuario}}</td>
          <td><h4><span class="badge badge-primary">{{$cobro->empresa->nombre}}</span></h4></td>
          <td >{{$cobro->monto}}</td>
          <th>{{$cobro->totalAnterior}}</th>
          <th>{{$cobro->totalActual}}</th>
          <th>{{$cobro->fecha}}</th>
          </tr>
          @endforeach
      </tbody>
    </table>
      {{ $cobros->links() }}
  </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@9') }}"></script>
	<script type="text/javascript" >


	</script>
@endpush