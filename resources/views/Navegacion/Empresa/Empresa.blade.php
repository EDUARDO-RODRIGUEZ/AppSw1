@foreach(Auth::guard('web')->user()->rol->rolacciones as $accion)
	@if($accion->eliminado == 0)
		@if($accion->idaccion == 1 )
			<li class="nav-item d-sm-inline-block">
			    <a class="nav-link" href="{{ route('productos.listar') }}">
			        Gestionar Productos  
			    </a>
			</li>
		@endif
		@if($accion->idaccion == 2 )
			<li class="nav-item d-sm-inline-block">
			    <a class="nav-link" href="{{ route('pedidos.listar') }}">
			        Gestionar Pedidos 
			    </a>
			</li>
		@endif
	@endif
@endforeach


