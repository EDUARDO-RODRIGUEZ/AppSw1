@extends('layout.plantilla')
    @section('contenido')
        <div class="card">
            <div class="card-header">
                @if(auth()->user()->rol->id == \App\Rol::$EMPRESA)
                    <h1>{{"Lista de Pedidos de ". auth()->user()->usuarioempresa->empresa->nombre }}</h1>
                @elseif(auth()->user()->rol->id == \App\Rol::$ADMINISTRADOR)
                    <h1>Lista de Pedidos</h1>
                @elseif(auth()->user()->rol->id == \App\Rol::$REPARTIDOR)
                    <h1>{{ "Mis pedidos : ".auth()->user()->repartidor->empresa->nombre }}</h1>
                @endif
            </div>
        <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="row px-4 py-2">
                    <div class="col"></div>
                    <div class="justify-content-end">
                        <form class="form-group" method ="get" action="{{ url('/pedidos/listar') }}">
                            <div class="row">
                                <div class="mb-3">
                                    <input type="text" name="nombre" class="form-control">
                                </div>
                                <div class="mb-3">


                                    <button  type="submit" class="btn btn-info form-control mb-2">
                                        <i class="fas fa-search"></i>Buscar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if(Session::has('flash_message'))
                <div class="px-2">
                    <div class="alert alert-success">
                        <span class="glyphicon glyphicon-ok"></span>{!! session('flash_message') !!}
                    </div>
                </div>
            @endif

            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        @if(auth()->user()->rol->id == \App\Rol::$ADMINISTRADOR)
                            <th>Id Empresa - Empresa</th>
                        @endif
                        <th>Cliente</th>
                        <th>NIT</th>
                        <th>Fecha y Hora</th>
                        <th>Total (Bs)</th>
                        <th>Detalle del Pedido</th>
                        <th>Estado Actual</th>
                        @foreach(auth()->user()->rol->rolprivilegioes as $privilegio)
                            @if($privilegio->idprivilegio == 6 && $privilegio->eliminado == 0)
                                <th>Asignar Repartidor</th>
                            @endif

                        @endforeach

                        @if(auth()->user()->rol->id == \App\Rol::$ADMINISTRADOR)
                            <th>Repartidor</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                @if (!empty($pedidos))

                @foreach($pedidos as $pedido)
                    <tr>
                        <td>{{$pedido->id}}</td>
                        @if(auth()->user()->rol->id == \App\Rol::$ADMINISTRADOR)
                            <td>{{ $pedido->idempresa.' - '.$pedido->empresa->nombre }}</td>
                        @endif
                    <!--{{ $cliente=$pedido->cliente }}-->
                        <td>{{$cliente->nombres.' '.$cliente->apellidos}}</td>
                        <td>{{$pedido->nit}}</td>
                        <td>{{$pedido->fechahora}}</td>
                        <td>{{$pedido->total}}</td>
                        <td>

                            <a type="button" class="btn btn-dark btn-lg" style="color: white"
                               href="{{route('detallePedidos.mostrar', [$pedido->id])}}">Ver Detalle</a>
                        </td>
                        <td> <!-- Estado actual -->




                            @foreach(auth()->user()->rol->rolprivilegioes as $privilegio)
                                        @if($privilegio->idprivilegio == 7 && $privilegio->eliminado == 0)
                                            @if(auth()->user()->rol->id != \App\Rol::$ADMINISTRADOR )
                                @switch($pedido->estadopedidoactual)
                                    @case(\App\Pedido::$PENDIENTE)
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Pendiente
                                        </button>
                                        <div class="dropdown-menu">
                                            @if(auth()->user()->rol->id == \App\Rol::$ADMINISTRADOR)
                                                <a class="dropdown-item" href={{ route('pedidos.cambiarEstado', [$pedido->id, \App\Pedido::$CANCELADO]) }}>Cancelar</a>
                                            @elseif(auth()->user()->rol->id == \App\Rol::$REPARTIDOR)
                                                <a class="dropdown-item" href={{ route('pedidos.cambiarEstado', [$pedido->id, \App\Pedido::$DESTINO]) }}>En Destino</a>
                                                <a class="dropdown-item" href={{ route('pedidos.cambiarEstado', [$pedido->id, \App\Pedido::$FINALIZADO]) }}>Finalizar</a>
                                                <a class="dropdown-item" href={{ route('pedidos.cambiarEstado', [$pedido->id, \App\Pedido::$CANCELADO]) }}>Cancelar</a>
                                            @endif
                                        </div>
                                    </div>
                                    @break
                                    @case(\App\Pedido::$CAMINO)
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            En Camino
                                        </button>
                                        <div class="dropdown-menu">
                                            @if(!empty(auth()->user()->usuarioempresa) && auth()->user()->rol->id != \App\Rol::$ADMINISTRADOR)
                                                <a class="dropdown-item" href={{ route('pedidos.cambiarEstado', [$pedido->id, \App\Pedido::$CANCELADO]) }}>Cancelar</a>
                                            @elseif(!empty(auth()->user()->repartidor) && auth()->user()->rol->id != \App\Rol::$ADMINISTRADOR)
                                                <a class="dropdown-item" href={{ route('pedidos.cambiarEstado', [$pedido->id, \App\Pedido::$DESTINO]) }}>En Destino</a>
                                                <a class="dropdown-item" href={{ route('pedidos.cambiarEstado', [$pedido->id, \App\Pedido::$FINALIZADO]) }}>Finalizar</a>
                                                <a class="dropdown-item" href={{ route('pedidos.cambiarEstado', [$pedido->id, \App\Pedido::$CANCELADO]) }}>Cancelar</a>
                                            @endif
                                        </div>
                                    </div>
                                    @break
                                    @case(\App\Pedido::$DESTINO)
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            En Destino
                                        </button>
                                        <div class="dropdown-menu">
                                            @if(!empty(auth()->user()->usuarioempresa) && auth()->user()->rol->id != \App\Rol::$ADMINISTRADOR)
                                                <a class="dropdown-item" href={{ route('pedidos.cambiarEstado', [$pedido->id, \App\Pedido::$CANCELADO]) }}>Cancelar</a>
                                            @elseif(!empty(auth()->user()->repartidor) && auth()->user()->rol->id != \App\Rol::$ADMINISTRADOR)
                                                <a class="dropdown-item" href={{ route('pedidos.cambiarEstado', [$pedido->id, \App\Pedido::$FINALIZADO]) }}>Finalizar</a>
                                                <a class="dropdown-item" href={{ route('pedidos.cambiarEstado', [$pedido->id, \App\Pedido::$CANCELADO]) }}>Cancelar</a>
                                            @endif
                                        </div>
                                    </div>
                                    @break
                                    @case(\App\Pedido::$FINALIZADO)
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                disabled>
                                            Finalizado
                                        </button>
                                    </div>
                                    @break
                                    @case(\App\Pedido::$CANCELADO)
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                disabled>
                                            Cancelado
                                        </button>
                                    </div>
                                    @break
                                    @default
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                disabled>
                                            Pendiente
                                        </button>
                                    </div>
                                @endswitch
                            @elseif(auth()->user()->rol->id == \App\Rol::$ADMINISTRADOR)
                                <div class="badge badge-primary text-wrap"
                                     style="width: 12rem; font-size: large; line-height: 1.5">
                                    @switch($pedido->estadopedidoactual)
                                        @case(\App\Pedido::$PENDIENTE)
                                        Pendiente
                                        @break
                                        @case(\App\Pedido::$CAMINO)
                                        En Camino
                                        @break
                                        @case(\App\Pedido::$DESTINO)
                                        En Destino
                                        @break
                                        @case(\App\Pedido::$FINALIZADO)
                                        Finalizado
                                        @break
                                        @case(\App\Pedido::$CANCELADO)
                                        Cancelado
                                        @break
                                        @default
                                        Pendiente
                                    @endswitch
                                </div>
                            @endif


                                        @endif

                            @endforeach






                        </td>
                        @foreach(auth()->user()->rol->rolprivilegioes as $privilegio)
                            @if($privilegio->idprivilegio == 6 && $privilegio->eliminado == 0)
                                @if(auth()->user()->rol->id == \App\Rol::$EMPRESA || auth()->user()->rol->id == \App\Rol::$ADMINISTRADOR || $privilegio->idprivilegio == 6 && $privilegio->eliminado == 0)
                            <td>
                                @if(auth()->user()->rol->id == \App\Rol::$EMPRESA || $privilegio->idprivilegio == 6 && $privilegio->eliminado == 0)
                                    @if($pedido->idrepartidor == null)
                                        @if($pedido->estadopedidoactual != \App\Pedido::$FINALIZADO && $pedido->estadopedidoactual != \App\Pedido::$CANCELADO)
                                        @foreach(auth()->user()->rol->rolprivilegioes as $privilegio)
                                            @if($privilegio->idprivilegio == 6 && $privilegio->eliminado == 0)
                                                <a class="btn btn-dark btn-lg" style="color: white"
                                               href="{{ route('pedidos.asignarRepartidor', [$pedido->id]) }}">Asignar Repartidor</a>
                                            @endif

                                        @endforeach

                                        @else
                                            @foreach(auth()->user()->rol->rolprivilegioes as $privilegio)
                                                @if($privilegio->idprivilegio == 6 && $privilegio->eliminado == 0)
                                                    <div class="badge badge-primary text-wrap"
                                                 style="width: 12rem; font-size: large; line-height: 1.5">
                                                El pedido fue cancelado antes de asignarle un repartidor
                                            </div>
                                                @endif

                                            @endforeach

                                        @endif
                                    @else
                                        <!--{{ $repartidorAsignado=$pedido->repartidor->usuario }} -->
                                        <div class="badge badge-primary text-wrap"
                                             style="width: 12rem; font-size: large; line-height: 1.5">
                                            Asignado a:<br>
                                            {{ $repartidorAsignado->name.' '.$repartidorAsignado->apellidos }}
                                        </div>
                                    @endif
                                @elseif(auth()->user()->rol->id == \App\Rol::$ADMINISTRADOR)
                                    @if($pedido->idrepartidor != null)
                                        <!--{{ $repartidorAsignado=$pedido->repartidor->usuario }} -->
                                        <div class="badge badge-primary text-wrap"
                                             style="width: 12rem; font-size: large; line-height: 1.5">
                                            Asignado a:<br>
                                            {{ $repartidorAsignado->name.' '.$repartidorAsignado->apellidos }}
                                        </div>
                                    @else
                                        <div class="badge badge-primary text-wrap"
                                             style="width: 12rem; font-size: large; line-height: 1.5">
                                            No Asignado
                                        </div>
                                    @endif
                                @endif
                            </td>
                        @endif
                            @endif

                        @endforeach

                    </tr>
                @endforeach
                @else
                    <div class="row alert alert-danger">No hay pedidos</div>
                @endif
                </tbody>
             </table>
        </div>
    @endsection

    @push('scripts')
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@9') }}"></script>
        <script type="text/javascript"></script>
    @endpush
