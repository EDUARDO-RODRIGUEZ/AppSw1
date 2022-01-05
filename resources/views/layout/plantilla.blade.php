<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Inicio| SistemaCompras</title>
<link href="{{asset('css/bootstrap-custom.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('plugins/fancybox/fancybox.min.css')}}" type="text/css" rel="stylesheet">

<link href="{{asset('plugins/prism/prism.css')}}" rel="stylesheet" >
<link href="{{asset('css/uikit.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />
<link src="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"></link>
    <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="{{asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">

    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css')}}"/>
  <link href="{{ asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('/plugins/summernote/summernote-bs4.css') }}">
   <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
  <style >
  nav.ssss{
  position: -webkit-sticky;  // required for Safari
    position: sticky;
    top: 0; // required as well.
}
</style>
<style>
.contenedor {
    margin: 1rem auto;
    border: 1px solid #aaa;
    background: #f1f2f3;
    overflow:auto;
    box-sizing: border-box;
    padding:0 1rem;
}

/* Estilos para motores Webkit y blink (Chrome, Safari, Opera... )*/

.contenedor::-webkit-scrollbar {
    -webkit-appearance: none;
}

.contenedor::-webkit-scrollbar:vertical {
    width:10px;
}

.contenedor::-webkit-scrollbar-button:increment,.contenedor::-webkit-scrollbar-button {
    display: none;
}

.contenedor::-webkit-scrollbar:horizontal {
    height: 10px;
}

.contenedor::-webkit-scrollbar-thumb {
    background-color: #797979;
    border-radius: 20px;
    border: 2px solid #f1f2f3;
}

.contenedor::-webkit-scrollbar-track {
    border-radius: 10px;
}
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */

      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
 <style>
nav.scrollmenu {
  overflow: auto;
  white-space: nowrap;
}
div.scrollmenu {
  overflow: auto;
  white-space: nowrap;
}
</style>
</head>

 <!--sidebar-mini layout-fixed-->
<body class="sidebar-mini layout-fixed" >


<div class="wrapper border-dark " >
  <!-- Navbar -->
  <nav class=" main-header navbar navbar-expand  navbar-dark border-info text-small ">
    <!-- Left navbar links -->


    <ul class="navbar-nav  ">

      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>


    </ul>

    <!-- SEARCH FORM -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto navbar-dark-light ">
      <!-- Messages Dropdown Menu -->
      @if(!Auth::guard('cliente')->check() && !Auth::guard('web')->check())
        <li class="nav-item d-sm-inline-block">
        <a data-toggle="modal" data-target="#sign-in-social" href class="nav-link">{{ __('Login')}}</a>
        </li>
        <li class="nav-item d-sm-inline-block">
        <a  href="{{url('/cliente/formulario')}}" class="nav-link">{{ __('Register')}}</a>
        </li>
      @endif


    @if(Auth::guard('cliente')->check())
      @include('Navegacion.'.\App\User::asignarNavegacion().'.'.\App\User::asignarNavegacion())
      <li class="nav-item dropdown">
      <a id="botonCarrito" class="nav-link btn border" href="{{ url('realizarPedido/carrito')}}">
      <i class="fas fa-shopping-cart fa-lg"></i>

      </a>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">13</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user "></i>

          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header text-lg">{{ Auth::guard('cliente')->user()->nombres }}</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item text-sm">
            <i class="fas fa-envelope mr-2 "></i>{{ Auth::guard('cliente')->user()->email }}
            <span class="float-right text-muted text-sm"></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          <div class="dropdown-divider"></div>
          <a href="{{ url('cliente/salir') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
              class="btn btn-danger dropdown-footer ">
              Salir
              <form id="logout-form" action="{{url('cliente/salir') }}" method="POST" style="display: none;">
                  @csrf
              </form>
         </a>
        </div>

      </li>
  @endif
    @if(Auth::guard('web')->check())


      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">13</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user "></i>

          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header text-lg">Dayler Taboada Frias</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item text-sm">
            <i class="fas fa-envelope mr-2 "></i> daylertaboada@hotmail.com
            <span class="float-right text-muted text-sm"></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
              class="btn btn-danger dropdown-footer ">
              Salir
              <form id="logout-form" action="{{route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
         </a>
        </div>

      </li>

  @else
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-cogs "></i>

        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right ">
          <span class="dropdown-header text-sm"><strong>{{__("Configuracion")}}</strong></span>

          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item text-sm disabled">
            <i class="fas fa-globe-americas mr-2 "></i> {{ __("Seleccionar idioma") }}
            <span class="float-right text-muted text-sm"></span>
          </a>
              <div class="dropdown-divider"></div>

              <div class="dropdown-divider"></div>
              <a data-toggle="modal" data-target="#login-usuarios " href class="dropdown-item text-sm">
            <i class="fas fa-envelope mr-2 "></i> Login usuarios
            <span class="float-right text-muted text-sm"></span>
          </a>
          </div>
      </li>

  @endif



     <!--col-->
    </ul>


  <!--container-->
  </nav>



  <!-- /.navbar -->

  </div>
    <div id="app" >
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-light elevation-2">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link navbar-dark">
      <img src="{{ '/storage/productos/HomeMarket.png'}}" style="width:50px; height: 50px;" alt="AdminLTE Logo" >
      <span class="brand-text font-weight-light" style="color: white;">HomeMarket</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar " >
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">@auth {{ auth()->user()->email }} @endauth</a>
        </div>
      </div>

      <!-- Sidebar Menu -->

      <nav class="mt-2" >
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"  >
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      @if(Auth::guard('web')->check())
        @include('Navegacion.'.\App\User::asignarNavegacion().'.'.\App\User::asignarNavegacion())
      @endif
      @if(Auth::guard('cliente')->check())
          <li  class="nav-item" >
            <a  href="" class="nav-link active ">
              <i class="nav-icon fas fa-th"></i>
              <p>
                inicio
              </p>
            </a>
          </li>
       @foreach($categorias as $categoria)
           <li class="nav-item has-treeview menu-open">
            <a class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                {{ $categoria->nombre }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            @foreach($categoria->subcategorias as $subcategoria)
            <ul class="nav nav-treeview">
              <li class="nav-item" >
                <a href="{{ url('subcategoria/'.$subcategoria->id.'/productos')}}"   class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ $subcategoria->nombre }}</p>
                </a>
              </li>
            </ul>
            @endforeach
          </li>
          @endforeach

          <li class="nav-item">
            <a href="{{ url('prueba') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
      @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

        <div  class="card p-3" style="background-color:#B4C4C6" >
            @if(Session::has('flash'))
                <div class="px-2">
                    <div class="alert alert-success">
                        <span class="glyphicon glyphicon-ok"></span> {!! session('flash') !!}
                    </div>
                </div>
            @endif

            @if(Session::has('incorrecto'))
                <div class="px-2">
                    <div class="alert alert-success">
                        <span class="glyphicon glyphicon-ok"></span> {!! session('incorrecto') !!}
                    </div>
                </div>
            @endif

            @if(Session::has('estadoPersonal'))
                <div class="px-2">
                    <div class="alert alert-success">
                        <span class="glyphicon glyphicon-ok"></span> {!! session('estadoPersonal') !!}
                    </div>
                </div>
            @endif

            @if(Session::has('estadoCliente'))
                <div class="px-2">
                    <div class="alert alert-success">
                        <span class="glyphicon glyphicon-ok"></span> {!! session('estadoCliente') !!}
                    </div>
                </div>
            @endif

            @yield('contenido')
            @if((!auth()->check() && !Auth::guard('cliente')->check()) || (Auth::guard('cliente')->check() && (Request::url() == route('home'))))
                <div class="card">
                    <h1 class="card-header" style="background-color: #2C3E50; color: white">
                        Bienvenido a Home Market! <br>Comprá desde tu casa, hasta tu casa!
                    </h1>
                    <div class="card-body" style="background-color: #566573">
                        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="/storage/images/inicio/inicio1.jpg" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h2 class="font-weight-bolder" style="color: black; font-size: 3.1rem">Bienvenido a Home Market!!</h2>
                                        <p class="font-weight-bolder" style="color: black; font-size: 1.6rem">Compra desde tu casa, hasta tu casa!</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="/storage/images/inicio/inicio2.jpg" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h2 class="font-weight-bolder" style="color: black; font-size: 3.1rem; background-color: #E33E4D">Descubre nuevas Empresas</h2>
                                        <p class="font-weight-bolder" style="color: black; background-color: #E33E4D; font-size: 1.5rem">Compra de empresas que no conocías, como también de tus favoritas!</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="/storage/images/inicio/inicio3.jpg" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h2 class="font-weight-bolder" style="font-size: 3.1rem; background-color: #225D8A ">Gestiona Tus propios Pedidos!</h2>
                                        <p class="font-weight-bolder" style="background-color: #225D8A; font-size: 1.6rem">Visuazliza el estado de tus pedidos en tiempo real</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="/storage/images/inicio/inicio4.jpg" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h2 class="font-weight-bolder" style="color: black; font-size: 3.1rem">Recíbelo desde la comodidad de tu Casa!</h2>
                                        <p class="font-weight-bolder" style="color: black; font-size: 1.6rem">Te lo entregamos en la puerta de tu casa!</p>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h2 class="card-header" style="background-color: #2C3E50; color: white">Echa un vistazo a los productos más vendidos! Accedé o Registrate para empezar a comprar Yá!</h2>
                    <div class="card-body" style="background-color: #566573">
                        <div class="row">
                        <!-- {{ $productos = \App\Producto::orderBy('idsubcategoria')->get() }} -->
                            @foreach($productos as $producto)
                                <div class="col-3">
                                    <figure class="card card-product" id="{{ $producto->id }}">
                                        <div class="card-header"  style="background-color:#A9E8F1">
                                            <h4 data-value="{{ $producto->nombre }}"
                                                class="title"><strong>{{ $producto->nombre }}</strong></h4></div>
                                        <div class="img-wrap py-2">
                                            <img data-imagen="{{ $producto->imagen }}"
                                                 src="{{ '/storage/images/productos/'.$producto->imagen  }}"
                                                 alt="{{ $producto->nombre }}"></div>
                                        <figcaption class="info-wrap">
                                            <h5 class="title" id="idempresa"
                                                data-value="{{ $producto->empresa->id }}">Empresa : <strong>{{ $producto->empresa->nombre }}</strong></h5>
                                            <p class="desc">{{Str::limit($producto->descripcion,70,'...')}}</p>
                                            <div class="rating-wrap stocks" data-stock="{{ $producto->stock }}">
                                                <div>Stock Actual : {{$producto->stock}}</div>
                                                <div class="price-wrap h5">
                                                    <span class="price-new">Precio : <span class="precios">{{ $producto->precio }} Bs.</span> </span> <del class="price-old text-danger"></del>
                                                </div>
                                            </div> <!-- rating-wrap.// -->
                                        </figcaption>
                                        <div class="row">
                                            <div class="col">
                                                <a href="{{ route('productos.ver', [$producto->id]) }}"
                                                   class="btn btn-secondary btn-lg active btn-block"
                                                   role="button" aria-pressed="true" style="background-color: #1FD291; font-size: 1.6rem; color:black">Detalles</a>
                                            </div>
                                            <!-- price-wrap.// -->
                                        </div> <!-- bottom-wrap.// -->
                                    </figure>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            @endif
            @if(auth()->check() && (Request::url() == route('home')))
                <!-- {{ $usuario=auth()->user() }} -->
                <div class="container">
                    <div class="card">
                        <h1 class="card-header">
                            {{ 'Bienvenido '.$usuario->name.' '.$usuario->apellidos.'!' }}
                        </h1>
                        <div class="card-body">
                            <div class="card mb-3" style="min-height: 30rem">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img src="{{ '/storage/images/usuarios/'.$usuario->imagen }}" class="card-img" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <p class="card-text" style="font-size: 1.5rem">
                                                <span style="font-size: 1.8rem" class="font-weight-bolder">Nombre : </span>{{ $usuario->name.' '.$usuario->apellidos }}</p>
                                            <p class="card-text" style="font-size: 1.5rem">
                                                <span style="font-size: 1.8rem" class="font-weight-bolder">CI : </span>{{ $usuario->ci }}</p>
                                            <p class="card-text" style="font-size: 1.5rem">
                                                <span style="font-size: 1.8rem" class="font-weight-bolder">Teléfono : </span>{{ $usuario->telefono }}</p>
                                            <p class="card-text" style="font-size: 1.5rem">
                                                <span style="font-size: 1.8rem" class="font-weight-bolder">Sexo : </span>
                                                @if($usuario->sexo == 1)
                                                        Masculino
                                                @else
                                                        Femenino
                                                @endif
                                            </p>
                                            <p class="card-text" style="font-size: 1.5rem">
                                                <span style="font-size: 1.8rem" class="font-weight-bolder">Tipo :
                                                </span>
                                                @switch($usuario->idrol)
                                                    @case(\App\Rol::$ADMINISTRADOR)
                                                        Administrador de Home Market
                                                    @break
                                                    @case(\App\Rol::$EMPRESA)
                                                        Personal de Empresa
                                                    @break
                                                    @case(\App\Rol::$REPARTIDOR)
                                                        Repartidor
                                                    @break
                                                    @default
                                                    Administrador de Home Market
                                                @endswitch
                                            </p>
                                            @if($usuario->idrol == \App\Rol::$EMPRESA || $usuario->idrol == \App\Rol::$REPARTIDOR)
                                                <p class="card-text" style="font-size: 1.5rem">
                                                    <span style="font-size: 1.8rem" class="font-weight-bolder">Empresa : </span>{{ $usuario->usuarioempresa->empresa->nombre }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


        </div>

    <!-- Main content  -->


  </div>

  </div>
  <!-- Main content -->
    @include('modal.login')

    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark" >
    <!-- Control sidebar content goes here -->
    <div class="p-3" >
      <h5>Title</h5>
      <p>Sidebar content</p>

              <!-- User image -->

                <img src="{{ asset('dist/img/user1-128x128.jpg') }}" class="img-circle img-size-50 mr-3 " alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>

              <!-- Menu Body -->

                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->

              <!-- Menu Footer-->
              <div class="row">
                <div class="col">
                  <a href="#" class="btn btn-success">Profile</a>
                </div>
                <div class="col">
                  <a href="#" class="btn btn-danger">Sign out</a>
                </div>
              </div>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
<!-- SweetAlert2 -->
<!-- jQuery -->

<!-- AdminLTE App -->
<!-- AdminLTE for demo purposes -->
<!-- Bootstrap 4 -->
<!-- AdminLTE App -->
<script src="{{asset('plugins/fancybox/fancybox.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js') }}"></script>

<!-- Toastr -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

<script>
 // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY3Rnm4HmJGlSTbx4Z3kFSSBN4UyKfgQQ&callback=initMap"
  type="text/javascript"></script>

<script type="text/javascript" src="{{ asset('https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js') }}"></script>
<script type="text/javascript">


</script>

@stack('scripts')


</body>
</html>
