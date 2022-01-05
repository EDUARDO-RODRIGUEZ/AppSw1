@extends('layout.plantilla')
    @section('contenido')
        <!-- {{ $pedido=$detallesDelPedido->first()->pedido }} -->
        <div class="card"> <!-- Pedido -->
            <h2 class="card-header">{{ 'Detalle del Pedido : '. $pedido->id }}</h2>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Id Pedido</div>
                                </div>
                                <input type="text" class="form-control"
                                       id="inlineFormInputGroupUsername2"
                                       value="{{ $pedido->id }}" readonly style="text-align: center">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">NIT</div>
                                </div>
                                <input type="text" class="form-control"
                                       id="inlineFormInputGroupUsername2"
                                       value="{{ $pedido->nit }}" readonly style="text-align: center">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Razón Social</div>
                                </div>
                                <input type="text" class="form-control"
                                       id="inlineFormInputGroupUsername2"
                                       value="{{ $pedido->razonSocial }}" readonly style="text-align: center">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Calle</div>
                                </div>
                                <input type="text" class="form-control"
                                       id="inlineFormInputGroupUsername2"
                                       value="{{ $pedido->calle }}" readonly style="text-align: center">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Referencia</div>
                                </div>
                                <textarea type="text" class="form-control"
                                          id="inlineFormInputGroupUsername2"
                                          readonly style="text-align: center"> {{ $pedido->referencia }} </textarea>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <h2 class="card-header">Productos</h2>
                    <div class="card-body">
                        <div class="row">
                            @foreach($detallesDelPedido as $detalle)
                                <div class="col-4">
                                    <div class="card mb-3">
                                        <div class="row no-gutters">
                                            <div class="col-md-4">
                                                <img src="{{ '/storage/images/productos/'.$detalle->producto->imagen }}" class="card-img" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h3 class="font-weight-bolder">{{ $detalle->producto->nombre }}</h3>
                                                    <p style="font-size: 1.3rem"><span class="font-weight-bold">Precio Unitario: </span>{{ $detalle->producto->precio }}</p>
                                                    <p style="font-size: 1.3rem"><span class="font-weight-bold">Descipcion: </span>{{ $detalle->producto->descripcion }}</p>
                                                    <p style="font-size: 1.3rem"><span class="font-weight-bold">Cantidad: </span>{{ $detalle->cantidad }}</p>
                                                    <p style="font-size: 1.3rem">
                                                        <small
                                                            class="text-muted"><span class="font-weight-bold">Subtotal: </span>{{ $detalle->subtotal }}</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="card"> <!-- Ubicacion -->
            <h2 class="card-header">Ubicación</h2>
            <div class="card-body">
                <td class="p-3" ><div class="p-3" id="map" data-latitud="{{ $pedido->latitud}}"  data-longuitud="{{ $pedido->longuitud }}"  style="width: auto;height: 200px;"></div></td>
            </div>
        </div>
        <div class="card"> <!-- Cliente y Repartidor -->
            <h2 class="card-header">Detalles del Cliente y Repartidor</h2>
            <div class="card-body">
                <div class="row">
                    <div class="col"> <!--Cliente-->
                        <!--{{ $cliente=$pedido->cliente }}-->
                        <div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{ '/storage/images/clientes/'.$cliente->imagen }}"
                                         class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <p style="font-size: 1.3rem"><span class="font-weight-bold">Nombre: </span>{{ $cliente->nombres.' '.$cliente->apellidos }}</p>
                                        <p style="font-size: 1.3rem"><span class="font-weight-bold">Teléfono: </span>{{ $cliente->telefono }}</p>
                                        <p style="font-size: 1.3rem"><span class="font-weight-bold">Sexo: </span>
                                            @if($cliente->sexo == 1)
                                                Masculino
                                            @else
                                                Femenino
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @if (!empty($revision))
                                <div class="row">
                                    <div class="col-3"><h5>Valoracion : </h5></div>
                                    <div class="col-3">
                                        @if ($revision->valoracion == 5)
                                            <ul class="rating-stars">
                                              <li  class="stars-active">
                                                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                              </li>
                                              <li>
                                                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                              </li>
                                            </ul>
                                            <div class="form-check form-check-inline">
                                              <label class="form-check-label" for="inlineRadio1">Muy bueno</label>
                                            </div>
                                        @endif
                                        @if ($revision->valoracion == 4)
                                            <ul class="rating-stars">
                                              <li  class="stars-active">
                                                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                              </li>
                                              <li>
                                                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                              </li>
                                            </ul>
                                            <div class="form-check form-check-inline">
                                              <label class="form-check-label" for="inlineRadio1">Bueno</label>
                                            </div>
                                        @endif
                                        @if ($revision->valoracion == 3)
                                            <ul class="rating-stars">
                                              <li  class="stars-active">
                                                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                              </li>
                                              <li>
                                                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                              </li>
                                            </ul>
                                            <div class="form-check form-check-inline">
                                              <label class="form-check-label" for="inlineRadio1">Regular</label>
                                            </div>
                                        @endif
                                        @if ($revision->valoracion == 2)
                                            <ul class="rating-stars">
                                              <li  class="stars-active">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                              </li>
                                              <li>
                                                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                              </li>
                                            </ul>
                                            <div class="form-check form-check-inline">
                                              <label class="form-check-label" for="inlineRadio1">Malo</label>
                                            </div>
                                        @endif
                                        @if ($revision->valoracion == 1)
                                            <ul class="rating-stars">
                                              <li  class="stars-active">
                                                <i class="fa fa-star"></i>
                                              </li>
                                              <li>
                                                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                              </li>
                                            </ul>
                                            <div class="form-check form-check-inline">
                                              <label class="form-check-label" for="inlineRadio1">Muy malo</label>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col"><textarea name="" class="form-control disabled" id="" cols="15" rows="5">{{ $revision->reseña }}</textarea></div>
                                </div>
                                <div class="row"> </div>
                            @else
                                <div class="row alert alert-danger"><h6>El cliente todavia no calificó el pedido</h6></div>
                            @endif
                        </div>
                    </div>
                    <div class="col"> <!--Repartidor-->
                        @if($pedido->idrepartidor != null)
                            <!--{{ $repartidor=$pedido->repartidor }}-->
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="{{ '/storage/images/usuarios/'.$repartidor->usuario->imagen }}" class="card-img" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <p style="font-size: 1.3rem"><span class="font-weight-bold">Nombre: </span>{{ $repartidor->usuario->name.' '.$repartidor->usuario->apellidos }}</p>
                                                <p style="font-size: 1.3rem"><span class="font-weight-bold">Cantidad de Pedidos actuales: </span>{{ $repartidor->cantidadDePedidos }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-danger" role="alert">
                                    Aún no se asignó un repartidor a este pedido
                                </div>
                                @if(! Auth()->guard('cliente')->check())
                                    @if(auth()->user()->rol->id == \App\Rol::$EMPRESA)
                                        @if($pedido->estadopedidoactual != \App\Pedido::$FINALIZADO && $pedido->estadopedidoactual != \App\Pedido::$CANCELADO)
                                            <a type="button" class="btn btn-dark btn-lg" style="color: white"
                                               href="{{route('pedidos.asignarRepartidor', [$pedido->id])}}">Asignar</a>
                                        @else
                                            <button class="btn btn-dark btn-lg" style="color: white"
                                                    disabled>El Pedido fue cancelado</button>
                                        @endif
                                    @endif
                                @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

    @endsection
@push('scripts')
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@9') }}"></script>
    <script type="text/javascript" >
      window.addEventListener("load", function(){
        var latitud = document.getElementById('map').getAttribute('data-latitud');
        var longuitud = document.getElementById('map').getAttribute('data-longuitud') ;
        console.log(latitud  + longuitud);
  // The location of Uluru
  var uluru = {lat: parseFloat(latitud), lng: parseFloat(longuitud)};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 14, center: uluru});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: uluru, map: map});

      });

    </script>
@endpush