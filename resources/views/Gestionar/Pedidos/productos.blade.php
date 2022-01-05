@extends('layout.plantilla')
@section('contenido')
  <div class="jumbotron jumbotron-fluid  p-4" >
              <div class="container row">
              	<div class="col">
				<h1 class="display-4">{{ $subcategorio->nombre }}</h1>
                <p class="lead">Se han encontrado {{ $resultados }} resultados</p>
              	</div >
              	<div class="col p-3">
              		<form class="form-group " method ="get" action="{{url('/subcategoria/'.$subcategorio->id.'/productos')}}">
						<div class="row mb-3">
							<div class="col">
							<select class="form-control " name="empresita">
							<option value=" ">Todas las empresas</option>
							@foreach($empresas as $empresa)
								<option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
							@endforeach
							</select>
							</div>

						</div>
              			<button  type="submit" class="btn btn-info form-control mb-2"><i class="fas fa-search"></i>  Buscar </button>
              		</form>
              	</div>

              </div>
   </div>
   <div class="p-4">
	@include('modal.detalle')
	<div class="row" id="listaProductos">
	@forelse($subcategorias as $producto)
	<div class="col-md-4">
	  <figure class="card card-product" id="{{ $producto->id }}">
	  	<div class="card-header"  style="background-color:#A9E8F1"><h4 data-value="{{ $producto->nombre }}"class="title"><strong>{{ $producto->nombre }}</strong></h4></div>
	    <div class="img-wrap py-2"><img data-imagen="{{ $producto->imagen }}" src="{{ '/storage/images/productos/'.$producto->imagen  }}" alt="{{ $producto->nombre }}"></div>
	    <figcaption class="info-wrap" >
	        <h5 class="title" id="idempresa" data-value="{{ $producto->empresa->id }}">Empresa :<strong>{{ $producto->empresa->nombre }}</strong></h5>
	        <p class="desc">{{Str::limit($producto->descripcion,70,'(Leer más)')}}</p>
	        <div class="rating-wrap stocks" data-stock="{{ $producto->stock }}">

	          {{-- <div class="label-rating">{{$producto->revisiones_count}}  valoraciones</div> --}}
	          <div class="label-rating">Stock : {{$producto->stock}}</div>
	          	      <div class="price-wrap h5">
	        <span class="price-new">Precio :<span class="precios">{{ $producto->precio }} Bs.</span> </span> <del class="price-old text-danger"></del>
                  <a href="" data-toggle="modal" id="Agregador" data-value="{{$producto->id}}" class="btn btn-sm  btn-outline-warning float-right ml-2 detalles">Detalles </a>
	      </div>
	        </div> <!-- rating-wrap.// -->
	    </figcaption>
	    <div  class="bottom-wrap row">
        <div class="col-4">
          <form id="formularioCarrito{{ $producto->id }}" method="POST" enctype="multipart/form-data">
          <select name="cantidad" class="form-control">
          @for ($i = 1; $i <= $producto->stock; $i++)
            <option value="{{ $i }}"> {{ $i }}</option>
          @endfor
          </select>
          </form>
        </div>
        <div class="col-8"><button  type="submit" data-id ="{{ $producto->id }}" class="btn btn-outline-primary float-right agregarCarrito w-100 h-100"> <i class="fas fa-shopping-cart fa-lg"></i></button></div>


 <!-- price-wrap.// -->
	    </div> <!-- bottom-wrap.// -->
	  </figure>
	</div>
	@empty
		<div class="alert-danger"> No hay productos en esta subcategoria</div>
	@endforelse
	</div> <!-- col // -->

	</div> <!-- row.// -->
	{{ $subcategorias->links() }}


@endsection
@push('scripts')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script type="text/javascript">
	//variables
	//eventos listeners

	//const lista =document.getElementById('listaProductos');
	//lista.addEventListener('click',verDetalle);
	//funciones
 function mostrarMensajeExitoso(message) {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    Toast.fire({
      type: 'success',
      title: message
    })

  };
   function mostrarMensajeFallido(message) {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
      Toast.fire({
        type: 'error',
        title: message
      })

  };

$.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
 $('.agregarCarrito').on('click', function(event){
  event.preventDefault();
  var id = this.getAttribute('data-id');
  var data = new FormData($('#formularioCarrito'+id)[0]);
  data.append('id',id);
   $.ajax({
    url:"/realizarPedido/agregarCarrito",
    method:"POST",
    data: data,
    contentType: false,
    cache:false,
    processData: false,
    dataType:"json",
    success:function(response)
    {
      if(response.success){
        console.log('inserto');
      mostrarMensajeExitoso(response.message);
      }else{
      mostrarMensajeFallido(response.message);
      console.log('fallo');
      }

    }
   });
  });


  /*
	function verDetalle(e){
		e.preventDefault();
		if(e.target.classList.contains('detalles')){
			console.log(e.target.getAttribute('data-value'));
			$.ajax({
				url: '/producto/detalle/'+e.target.getAttribute('data-value'),
				type: 'GET',
				dataType: 'json'
			})
			.done(function(data) {
				console.log("success");
				document.getElementById('nombre').innerHTML=data.producto.nombre;
				document.getElementById('descripcion').innerHTML=data.producto.descripcion;
				document.getElementById('imagen').setAttribute('src','/imagenes/productos/'+data.producto.imagen);
				document.getElementById('precio').innerHTML=data.producto.precio;
				document.getElementById('empresa').innerHTML=data.producto.empresa.nombre;
				document.getElementById('subcategoria').innerHTML=data.producto.subcategoria.nombre;
				document.getElementById('categoria').innerHTML=data.producto.subcategoria.categoria.nombre;
				let html ='';
				for(let i=1 ; i<=data.promedio; i++){
					html = html+'<i class="fa fa-star"></i>';
				}
				document.getElementById('valoracion').innerHTML=html;
				document.getElementById('stock').innerHTML=data.producto.stock;
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});


		}
		if(e.target.classList.contains('agregarCarrito')){

			const tarjeta =e.target.parentElement.parentElement;
			const nombre = tarjeta.querySelector('h4').textContent;
			const producto ={
				nombre :  tarjeta.querySelector('h4').textContent,
				precio :  tarjeta.querySelector('.precios').textContent,
				id :  tarjeta.getAttribute('id'),
				imagen : tarjeta.querySelector('img').getAttribute('data-imagen'),
				stock :  tarjeta.querySelector('.stocks').getAttribute('data-stock'),
				stockActual:1,
        idempresa : tarjeta.querySelector('#idempresa').getAttribute('data-value'),
			}
			let productos = obtenerLocalStorage();
			let verificar=2 ;//repetido 0 ; lleno 1 ; nuevo 2;
      let primerElemento = productos[0];
			productos.forEach( function(elemento, indice) {
				if(producto.id===elemento.id ){
					verificar=0;
					producto.stockActual = elemento.stockActual+1;
					eliminarCursoLocalStorage(producto.id);
					guardarLocalStorage(producto);
				}
			});
			if(verificar===0){
			}
			if(verificar===2){
              if(Object.entries(productos).length === 0 ){
                guardarLocalStorage(producto);

              }else{
              if(primerElemento.idempresa===producto.idempresa){
                guardarLocalStorage(producto);
              }
              }
			}

		}
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