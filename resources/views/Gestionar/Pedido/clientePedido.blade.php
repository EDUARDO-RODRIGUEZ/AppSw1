@extends('layout.plantilla')
@section('contenido')
<div class="row card">
	<div class="card-header px-4 pt-2 pb-2">
		<h3 class="p-2">Tus pedidos</h3>
		<div class="row">

			<div id="ofertas" class="col-sm col-xl-3 ofertitas">
			</div>
		</div>
		<div class="loader"></div>
	</div>
	<div class="car-body ml-2 pl-4 mt-2 mb-2 " style="width:97%">
		<table  class="table table-border"  style="width:100%" >
			<thead class="table-info">
				<tr>
					<th scope="col">Id del pedido</th>
					<th scope="col">Empresa</th>
					<th  scope="col">Fecha y hora</th>

					<th  scope="col">Razón social</th>
					<th  scope="col">NIT</th>
					<th  scope="col">Total</th>
					<th  scope="col">Estado de pedido</th>
					<th  scope="col">Accion</th>
					<th  scope="col">Calificar</th>
				</tr>
			</thead>
			<tbody class="table-sm">

					@foreach($pedidos as $pedido)
					<tr>
						<td>{{$pedido->id}}</td>
						<td><strong>{{$pedido->empresa->nombre}}</strong></td>
						<td><strong>{{$pedido->fechahora}}</strong>
						</td>
						<td>{{$pedido->razonSocial}}</td>

						<td>{{$pedido->nit}}</td>
						<td>{{ $pedido->total }} Bs.</td>
						<td>
							@if($pedido->estadopedidoactual == 1)
								<h5><span class="badge badge-pill badge-secondary">PENDIENTE</span></h5>
							@endif
							@if($pedido->estadopedidoactual == 2)
								<h5><span class="badge badge-pill badge-secondary">EN CAMINO</span></h5>
							@endif
							@if($pedido->estadopedidoactual == 3)
								<h5><span class="badge badge-pill badge-primary">EN DESTINO</span></h5>
							@endif
							@if($pedido->estadopedidoactual == 4)
								<h5><span class="badge badge-pill badge-success">FINALIZADO</span></h5>
							@endif
							@if($pedido->estadopedidoactual == 5)
								<h5><span class="badge badge-pill badge-danger">CANCELADO</span></h5>
							@endif
						</td>


						<td><a class="btn btn-light btn-sm"   href="{{route('detallePedidos.mostrar', [$pedido->id])}}"> Detalle   <i class="far fa-list-alt"></i> </a></td>
						@if (empty($pedido->revision))
							@if ($pedido->estadopedidoactual == 4)
								<td><a class="btn btn-light btn-sm"   href="{{ url('/realizarRevision/form/'.$pedido->id) }}  "> Valorar  <i class="fas fa-feather-alt"></i> </a></td>
							@else
								<td><a class="btn btn-light btn-sm disabled"  > Pendiente  <i class="fas fa-feather-alt"></i> </a></td>
							@endif
						@else
							@if (!empty($pedido->revision))
								<td><a class="btn btn-success btn-sm disabled"   > Valorado  <i class="fas fa-feather-alt"></i> </a></td>
							@endif
						@endif

					</tr>
					@endforeach

			</tbody>
			<tfoot>

				<tr>
					<th>Id del pedido</th>
					<th>Productos</th>
					<th >Detalle</th>
					<th >Calle</th>
					<th >Referencia</th>
					<th >Nit</th>
					<th >Razón social</th>
					<th >Accion</th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>s
@endsection