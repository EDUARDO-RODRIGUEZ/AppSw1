@extends('layout.plantilla')
@section('contenido')
<div class="card">
    <div class="card-header">
        <h3>
            Bitacora de usuarios
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <div class="row px-4 py-2">
            <div class="col">
            </div>
            <div class="justify-content-end">
                <form action="{{url('/bitacora/listar')}}" class="form-group" method="get">
                    <div class="row">
                        <div class="mb-3">
                            <input class="form-control" name="id" type="text">
                            </input>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-info form-control mb-2" type="submit">
                                <i class="fas fa-search">
                                </i>
                                Buscar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>
                        Id
                    </th>
                    <th>
                        Id de usuario
                    </th>
                    <th>
                        Acción
                    </th>
                    <th>
                        Fecha y hora
                    </th>
                    <th>
                        Descripción
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($bitacoras as $bitacora)
                <tr>
                    <th>
                        {{$bitacora->id}}
                    </th>
                    <td>
                        {{$bitacora->idusuario}}
                    </td>
                    <td>
                        @if($bitacora->idtipobitacora == 1)
                        <h4>
                            <span class="badge badge-secondary">
                                Inició sesion
                            </span>
                        </h4>
                        @endif
                        @if($bitacora->idtipobitacora == 2)
                        <h4>
                            <span class="badge badge-warning">
                                Editó o actualizó
                            </span>
                        </h4>
                        @endif
                        @if($bitacora->idtipobitacora == 3)
                        <h4>
                            <span class="badge badge-primary">
                                Registró
                            </span>
                        </h4>
                        @endif
                        @if($bitacora->idtipobitacora == 4)
                        <h4>
                            <span class="badge badge-danger">
                                Eliminó
                            </span>
                        </h4>
                        @endif
                        @if($bitacora->idtipobitacora == 5)
                        <h4>
                            <span class="badge badge-info">
                                Cobró
                            </span>
                        </h4>
                        @endif
                        @if($bitacora->idtipobitacora == 6)
                        <h4>
                            <span class="badge badge-danger">
                                Salió
                            </span>
                        </h4>
                        @endif
                    </td>
                    <td>
                        {{$bitacora->fechahora}}
                    </td>
                    <th>
                        {{$bitacora->detalle}}
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $bitacoras->links() }}
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@9') }}">
</script>
<script type="text/javascript">
</script>
@endpush
