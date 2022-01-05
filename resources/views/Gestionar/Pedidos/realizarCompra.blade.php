@extends('layout.plantilla')
@section('contenido')

	<div class="card p-3">
@if(Session::has('flash_message'))
      <div class="px-2"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> {!! session('flash_message') !!}</div>@if(!empty($errorcito)) $errorcito @endif</div>

      @endif
<ul class="nav nav-pills row mb-3" id="pills-tab" role="tablist">
  <li class="nav-item col" role="presentation">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Productos a confirmar</a>
  </li>
  <li class="nav-item col" role="presentation">
    <a class="nav-link disabled" id="pills-profile-tab"  href="{{url('realizarPedido/formularioDireccion')}}" role="tab" aria-controls="pills-profile" aria-selected="false">Formulario de dirección</a>
  </li>
  <li class="nav-item col" role="presentation">
    <a class="nav-link disabled" id="pills-contact-tab"  data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Aceptar terminos y condiciones</a>
  </li>
</ul>


<div class="tab-content bg-white" id="pills-tabContent">
  <div class="tab-pane bg-white fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
  		<div class="row">
  			<div class="col">
  				<div id="carritoCompras" class=" bg-white contenedor carrito m-1" style="border-radius: 5px 5px 5px 5px;
-moz-border-radius: 5px 5px 5px 5px;
-webkit-border-radius: 5px 5px 5px 5px;  border-color: #D9D9D9;">
            <p class="text-danger" id="mensaje"></p>
            <table class="table table-hover table-sm shopping-cart-wrap bg-white ">
              <thead class="text-muted">
              <tr>
                <th scope="col" width="50">Imagen</th>
                <th scope="col" width="100">Producto</th>
                <th scope="col" width="100">Cantidad</th>
                <th scope="col" width="100">Precio</th>
                <th scope="col" width="100">Subtotal</th>
                <th scope="col" width="100" class="text-right">Eliminar</th>
              </tr>
              </thead>
              <tbody id="carritoCompra">
                @if(!empty($productos))
                @foreach($productos as $producto)
                <tr>
                  <td>
                    <div class="img-wrap"><img src="{{ '/storage/images/productos/'.$producto->imagen  }}" class="img-thumbnail img-lg" style="width: 60px; height:60px;"></div>
                  </td>
                  <td class="align-middle">
                    <h6 ><strong class="text-muted" >{{ Str::limit($producto->nombre)}}</strong></h6>
                    </td>
                  <td class="align-middle">
                    <form id="formularioCarrito{{ $producto->id }}" action="POST" enctype="multipart/form-data">
                      @csrf
                    <select name="cantidad" data-id ="{{$producto->id}}" class="form-control actualizarStock">
                    @for ($i = 1; $i <= $producto->stock; $i++)
                      @if($producto->cantidad == $i)
                    <option selected="" value="{{ $i }}" >{{ $i }}</option>

                      @else
                    <option value="{{ $i }}" >{{ $i }}</option>

                      @endif
                    @endfor
                    </select>
                    </form>
                  </td>
                  <td class="align-middle">
                    <div class="price-wrap">
                    <var class="price">{{ $producto->precio }} Bs</var>
                    </div>
                  </td>
                  <td class="align-middle">
                    <div class="price-wrap">
                    <var class="price">{{ $producto->subtotal }} Bs</var>
                    </div>
                  </td>
                  <td class="align-middle text-right">
                    <a href="{{url('realizarPedido/eliminar/'.$producto->id)}}" class="btn btn-outline-danger eliminarCarrito" id="2" > × Eliminar</a>
                  </td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
            @if(empty($productos)) <p class="text-danger text-center">El carrito esta vacio</p>@endif
            <table  class="table table-hover table-sm shopping-cart-wrap">
              <thead class="text-muted">
                <tr>
                  <th><a href="{{ url('realizarPedido/vaciar') }}" class="btn btn-outline-danger w-100">VACIAR</a></th>
                </tr>
              </thead>
            </table>
		</div>
  			</div>
  			<div class="col-4 m-2">
  				<div class="card">
            <div class="card-header">
              <h5 class=" text-success text-center">Detalle de compra</h5>
            </div>
            <div class="card-body">
              <h4 class=" text-success">Empresa :<span class="badge badge-success">@if(!empty($empresa)){{ $empresa}}<span>@else Ninguna @endif</h4>
              <h3 class=" text-success">Total : <span class="badge badge-success">@if(!empty($total)){{$total}}@else 0 @endif</span> </h3>
            </div>
            <div></div>
          </div>
          @if(empty($productos))
           <a class="btn btn-success w-100 disabled"  href="{{url('realizarPedido/formularioDireccion')}}" >SIGUIENTE</a>
          @else
            <a class="btn btn-success w-100"  href="{{url('realizarPedido/formularioDireccion')}}" >SIGUIENTE</a>
          @endif

  			</div>


  		</div>


  </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
      <div class="row">
        <div class="col border">
          <h3 class="text"> Introduzca los datos de su ubicacion</h3>
        </div>
        <div class="col-4 m-2">
          <div class="card">
            <div class="card-header">
              <h5 class=" text-success text-center">Detalle de compra</h5>
            </div>
            <div class="card-body">
              <h4 class=" text-success">Empresa :<span class="badge badge-success">@if(!empty($empresa)){{ $empresa}}<span>@else Ninguna @endif</h4>
              <h3 class=" text-success">Total : <span class="badge badge-success">@if(!empty($total)){{$total}}@else 0 @endif</span> </h3>
            </div>
            <div></div>
          </div>
        </div>
      </div>
    </div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
</div>


	</div>


@endsection
@push('scripts')
<script type="text/javascript">
  function actualizar(){location.reload(true);}
  $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
 $('.actualizarStock').change(function(event){
  event.preventDefault();
  var id = this.getAttribute('data-id');
  var data = new FormData($('#formularioCarrito'+id)[0]);
  data.append('id',id);
   $.ajax({
    url:"/realizarPedido/actualizar",
    method:"POST",
    data: data,
    contentType: false,
    cache:false,
    processData: false,
    dataType:"json",
    success:function(response)
    {
      if(response.success){
    actualizar();
      }
    }
   });
  });
	//variables
	//eventos listeners

/*
	document.addEventListener('DOMContentLoaded', imprimirCarrito);
	//funciones
	$('#carritoCompras').on('click','.eliminarCarrito',eliminarCarrito);
	function eliminarCarrito(e){
		e.preventDefault();

		console.log(this.parentElement.parentElement);
		let fila = this.parentElement.parentElement;
		$(fila).fadeTo("normal", 0,function(){
		fila.remove();
		});
		eliminarCursoLocalStorage(this.getAttribute('id'));
	}

	function imprimirCarrito(){
		productos = obtenerLocalStorage();
    if(Object.entries(productos).length === 0 ){
      let mensaje = document.getElementById('mensaje');
      mensaje.innerHTML='No tiene ningun producto en el carrito'
    }
		productos.forEach( function(producto) {
		const fila = document.createElement('tr');
		const tabla = document.getElementById('carritoCompra');
		const nombre =producto.nombre;
		let html = `
			<td>
              <div class="img-wrap"><img src="/storage/productos/${producto.imagen}" class="img-thumbnail img-lg" style="width: 60px; height:60px;"></div>
            </td>
            <td class="align-middle">
              <h6 ><strong class="text-muted" >{{ Str::limit('${nombre}','10','(..)')}}</strong></h6>
            </td>
            <td class="align-middle">
              <input type="number" class="form-control input-${producto.id}" max="${producto.stock}" value="${producto.stockActual}">
              </td>
            <td class="align-middle">
              <div class="price-wrap">
                <var class="price">${producto.precio} Bs</var>
              </div>
            </td>
            <td class="align-middle text-right">
            <a href="" class="btn btn-outline-danger eliminarCarrito" id="${producto.id}" > × Remove</a>
            </td>
 `
			fila.innerHTML=html;
			tabla.appendChild(fila);
		});
	}
	function eliminarCursoLocalStorage(id) {
    let productosLS;
    productosLS = obtenerLocalStorage();
    productosLS.forEach(function(productoLS, index) {
        if(productoLS.id === id) {
            productosLS.splice(index, 1);
        }
    });
    localStorage.setItem('productos', JSON.stringify(productosLS) );
	}

	function guardarLocalStorage(producto){
		let productos;
		productos = obtenerLocalStorage();
		productos.push(producto);
		localStorage.setItem('productos',JSON.stringify(productos));
	}
	function obtenerLocalStorage(){
     let cursosLS;

     // comprobamos si hay algo en localStorage
     if(localStorage.getItem('productos') === null) {
          cursosLS = [];
     } else {
          cursosLS = JSON.parse( localStorage.getItem('productos') );
     }
     return cursosLS;
	}*/
</script>
@endpush