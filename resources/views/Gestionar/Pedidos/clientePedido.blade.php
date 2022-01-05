@extends('layout.plantilla')
@section('contenido')
<div class="row card">
    <div class="card-header px-4 pt-2 pb-2">
        <h3 class="p-2">
            Tus pedidos
        </h3>
        <div class="row">
            <div class="col-sm col-xl-3">
                <select class="form-control select2 " id="filter_gender" name="filter_gender">
                    <option selected="" value="3">
                        Activados y Desactivados
                    </option>
                    <option value="0">
                        Desactivado
                    </option>
                    <option value="1">
                        Activado
                    </option>
                </select>
            </div>
            <div class="col-sm col-xl-3 ofertitas" id="ofertas">
            </div>
        </div>
        <div class="loader">
        </div>
    </div>
    <div class="car-body ml-2 pl-4 mt-2 mb-2 " style="width:97%">
        <table class="table table-border" style="width:100%">
            <thead class="table-info">
                <tr>
                    <th scope="col">
                        Id del pedido
                    </th>
                    <th scope="col">
                        Empresa
                    </th>
                    <th scope="col">
                        Productos
                    </th>
                    <th scope="col">
                        Razón social
                    </th>
                    <th scope="col">
                        NIT
                    </th>
                    <th scope="col">
                        Estado de pedido actual
                    </th>
                    <th scope="col">
                        Metodo de pago
                    </th>
                    <th scope="col">
                        Accion
                    </th>
                </tr>
            </thead>
            <tbody class="table-sm">
                @foreach($pedidos as $pedido)
                <tr>
                    <td>
                        {{$pedido->id}}
                    </td>
                    <td>
                        <strong>
                            {{$pedido->empresa->nombre}}
                        </strong>
                    </td>
                    <td>
                        <ul>
                            @foreach($pedido->detallePedidos as $producto)
                            <li>
                                {{ $producto->nombre}}
                            </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        {{$pedido->razonSocial}}
                    </td>
                    <td>
                        {{$pedido->nit}}
                    </td>
                    <td>
                        @if($pedido->estadopedidoactual == 1)
                        <h5>
                            <span class="badge badge-pill badge-secondary">
                                PENDIENTE
                            </span>
                        </h5>
                        @endif
							@if($pedido->estadopedidoactual == 2)
                        <h5>
                            <span class="badge badge-pill badge-secondary">
                                EN CAMINO
                            </span>
                        </h5>
                        @endif
							@if($pedido->estadopedidoactual == 3)
                        <h5>
                            <span class="badge badge-pill badge-primary">
                                EN DESTINO
                            </span>
                        </h5>
                        @endif
							@if($pedido->estadopedidoactual == 4)
                        <h5>
                            <span class="badge badge-pill badge-success">
                                FINALIZADO
                            </span>
                        </h5>
                        @endif
							@if($pedido->estadopedidoactual == 5)
                        <h5>
                            <span class="badge badge-pill badge-danger">
                                CANCELADO
                            </span>
                        </h5>
                        @endif
                    </td>
                    <td>
                        @if($pedido->tipodepago == 1)
                        <h5>
                            <span class="badge badge-pill badge-secondary">
                                EFECTIVO
                            </span>
                        </h5>
                        @else
                        <h5>
                            <span class="badge badge-pill badge-info">
                                TARJETA
                            </span>
                        </h5>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-light btn-sm">
                            Detalle
                            <i class="far fa-list-alt">
                            </i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>
                        Id del pedido
                    </th>
                    <th>
                        Empresa
                    </th>
                    <th>
                        Fecha y hora
                    </th>
                    <th>
                        Razón social
                    </th>
                    <th>
                        NIT
                    </th>
                    <th>
                        Total
                    </th>
                    <th>
                        Estado de pedido
                    </th>
                    <th>
                        Accion
                    </th>
                    <th>
                        Calificar
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
s
@endsection
