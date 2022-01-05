@extends('layout.plantilla')
    @section('contenido')
<div class="card">
    <h1 class="card-header">
        {{ "Asigne Repartidor al pedido ".$pedido->id }}
    </h1>
    <div class="card-body">
        <div class="container">
            <div class="row">
                @foreach($repartidores as $repartidor)
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img alt="..." class="card-img" src="{{ '/storage/images/usuarios/'.$repartidor->usuario->imagen }}">
                                </img>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h3 class="font-weight-bolder text-monospace">
                                        {{ 'Nombre: '.$repartidor->usuario->name.' '.$repartidor->usuario->apellidos }}
                                    </h3>
                                    <p style="font-size: 1.5rem">
                                        {{ 'Cantidad de Pedidos: '.$repartidor->cantidadDePedidos }}
                                    </p>
                                    <a class="btn btn-dark btn-lg" href="{{ route('pedidos.guardarRepartidor', [$pedido->id, $repartidor->id]) }}" style="color: white">
                                        Asignar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-4">
                    <a class="btn btn-outline-danger w-100" href="{{ route('pedidos.listar') }}">
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
