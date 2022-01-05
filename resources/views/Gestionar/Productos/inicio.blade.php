@extends('layout.plantilla')
    @section('contenido')
        <div class="card">
            <h1 class="card-header">
                @if(auth()->user()->rol->id != \App\Rol::$ADMINISTRADOR)
                    @if( ! empty( auth()->user()->usuarioempresa ))
                        {{ "Lista de Productos de ".auth()->user()->usuarioempresa->empresa->nombre }}
                    @else 
                        {{ "Lista de Productos de ".auth()->user()->repartidor->empresa->nombre }}
                    @endif
                    
                @elseif(auth()->user()->rol->id == \App\Rol::$ADMINISTRADOR)
                    Lista de Productos
                @endif
            </h1>
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        @if(auth()->user()->rol->id != \App\Rol::$ADMINISTRADOR)
                            @foreach(auth()->user()->rol->rolprivilegioes as $privilegio)
                                @if($privilegio->idprivilegio == 3 && $privilegio->eliminado == 0)
                                <a href="{{ route('productos.crear') }}" class="btn btn-outline-success ">
                                    <i class="fas fa-plus-circle"></i> Registrar </a>
                                @endif
                                
                            @endforeach
                            
                        @endif
                    </div>

                    @foreach(auth()->user()->rol->rolprivilegioes as $privilegio)
                            @if($privilegio->idprivilegio == 2 && $privilegio->eliminado == 0)
                                <div class="col-3">
                                <form method ="GET" action="{{ route('productos.listar') }}">
                                <div class="row justify-content-end">
                                    <div class="mb-3">
                                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                                    </div>
                                    <div class="mb-3">
                                        <button  type="submit" class="btn btn-info form-control mb-2">
                                            <i class="fas fa-search"></i>  Buscar </button>
                                    </div>
                                </div>
                                </form>
                                </div>
                            @endif
                    @endforeach


                    
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                @if(auth()->user()->rol->id == \App\Rol::$ADMINISTRADOR)
                                    <th>Id Empresa - Empresa</th>
                                @endif
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Imagen</th>
                                <th>Categoria : Subcategoria</th>
                                @if(auth()->user()->rol->id != \App\Rol::$ADMINISTRADOR)
                                    @foreach(auth()->user()->rol->rolprivilegioes as $privilegio)
                                    @if($privilegio->idprivilegio == 4 && $privilegio->eliminado == 0)
                                        <th>Actualizar Stock</th>
                                    @endif

                                    @endforeach
                                    <th>Acciones</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($productos as $producto)
                                    <tr>
                                        <td>{{ $producto->id }}</td>
                                        @if(auth()->user()->rol->id == \App\Rol::$ADMINISTRADOR)
                                            <td>{{ $producto->empresa->id.'-'.$producto->empresa->nombre }}</td>
                                        @endif
                                        <td>{{ $producto->nombre }}</td>
                                        <td>
                                            <textarea type="text" class="form-control"
                                                      id="inlineFormInputGroupUsername2"
                                                      readonly style="text-align: left; height: 200px"> {{ $producto->descripcion }} </textarea>
                                        </td>
                                        <td>{{ $producto->precio }}</td>
                                        <td>{{ $producto->stock }}</td>
                                        <td>
                                            <img src="{{ '/storage/images/productos/'.$producto->imagen }}"
                                                 style="width: 200px; height:200px;">
                                        </td>
                                        <td>{{ $producto->subcategoria->categoria->nombre.' : ' }} <span class="font-weight-bolder">{{ $producto->subcategoria->nombre }}</span></td>
                                        @if(auth()->user()->rol->id != \App\Rol::$ADMINISTRADOR)
                                                @foreach(auth()->user()->rol->rolprivilegioes as $privilegio)
                                                    @if($privilegio->idprivilegio == 4 && $privilegio->eliminado == 0)
                                                        <td>
                                                        <a type="button" class="btn btn-warning btn-lg btn-block"
                                                        href="{{ route('productos.aumentarStock', [$producto->id]) }}">Actualizar Stock</a>
                                                        </td>
                                                    @endif
                                                @endforeach
                                                
                                            
                                            <td>

                                                @foreach(auth()->user()->rol->rolprivilegioes as $privilegio)
                                                    @if($privilegio->idprivilegio == 1 && $privilegio->eliminado == 0)
                                                    <!--Ver-->
                                                <a class="mr-3" href="{{ route('productos.ver', [$producto->id]) }}"
                                                   data-id="1" style="background: #F4F7F9;   -webkit-border-radius: 50px;
                                                  -moz-border-radius: 50px;
                                                  border-radius: 50px; color: #0353FF;"><i class="fas fa-eye fa-sm"></i></a>
                                                    @endif
                                                    
                                                @endforeach


                                                @foreach(auth()->user()->rol->rolprivilegioes as $privilegio)
                                                    @if($privilegio->idprivilegio == 4 && $privilegio->eliminado == 0)
                                                    <!--Editar-->
                                                <a class="mr-3" href="{{ route('productos.editar', [$producto->id]) }}"
                                                   data-id="1" style="background: #F4F7F9;color: #0353FF;
                                               -webkit-border-radius: 50px; -moz-border-radius: 50px;"><i
                                                        class="fas fa-user-edit fa-sm"></i></a>
                                                    @endif
                                                    
                                                @endforeach

                                                @foreach(auth()->user()->rol->rolprivilegioes as $privilegio)
                                                    @if($privilegio->idprivilegio == 5 && $privilegio->eliminado == 0)
                                                    <!--Ver-->
                                                <!--Eliminar-->
                                                <a class="mr-3" href data-toggle="modal"
                                                   data-target="#eliminar{{ $producto->id }}" data-id="1"
                                                   style="color: #0353FF;background: #F4F7F9;
                                               -webkit-border-radius: 50px;-moz-border-radius: 50px;"><i
                                                        class="fas fa-trash-alt fa-sm"></i></a>
                                                    @endif
                                                    
                                                @endforeach
                                                
                                                
                                                
                                            </td>
                                        @endif
                                    </tr>
                                    <!-- /.Modal para eliminar -->
                                    <div class="modal fade" id="eliminar{{ $producto->id }}"
                                         data-backdrop="static" data-keyboard="false"
                                         tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title"
                                                        id="staticBackdropLabel">Eliminar Producto</h3>
                                                    <button type="button" class="close"
                                                            data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="font-weight-bold">¿Está seguro que desea eliminar el producto?, los cambios serán irreversibles</p>
                                                    <ul>
                                                        <li>{{ 'Id: '.$producto->id }}</li>
                                                        <li>{{ 'Nombre: '.$producto->nombre }}</li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST"
                                                          action="{{ route('productos.eliminar', [$producto->id]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        <button type="submit"
                                                                href class="btn btn-danger">Si, eliminar.</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.FIN Modal para eliminar -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection

