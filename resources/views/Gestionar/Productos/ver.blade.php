@extends('layout.plantilla')
    @section('contenido')
        <div class="card">
            <h1 class="card-header">
                @if (Auth()->check())
                    @if(auth()->user()->rol->id == \App\Rol::$EMPRESA)
                        {{ "Producto ".$producto->id.' de la empresa '.auth()->user()->usuarioempresa->empresa->nombre }}
                    @elseif(auth()->user()->rol->id == \App\Rol::$ADMINISTRADOR)
                        {{ "Producto ".$producto->id.' de la empresa '.(\App\Empresa::where('id', $producto->idempresa))->get()->nombre }}
                    @endif
                @endif
                Detalles de producto

            </h1>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                       value="{{ $producto->nombre }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <textarea type="text" class="form-control"
                                          id="descripcion" name="descripcion"
                                          readonly>{{ $producto->descripcion }}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="stock">Stock</label>
                                    <input type="number" class="form-control" id="stock" name="stock"
                                           value="{{ $producto->stock }}" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="precio">Precio</label>
                                    <input type="number" class="form-control" id="precio" name="precio"
                                           value="{{ $producto->precio }}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="subcategoria">Subcategoria</label>
                                    <input type="text" class="form-control" id="subcategoria" name="subcategoria"
                                           value="{{ $producto->subcategoria->categoria->nombre.' : '. $producto->subcategoria->nombre }}" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12">
                                    <label style="" class="form-group">Imagen :</label>
                                </div>
                                <div class="col-12 justify-content-center">
                                    <img alt src="{{ '/storage/images/productos/'.$producto->imagen }}" id="im" style="width:300px; height:300px;">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-3">
                                    <br>
                                    <a href="{{ Auth()->check() ? route('productos.listar') : route('home') }}"
                                       class="btn btn-outline-danger w-100">Atrás</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script src="{{ asset('/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
        <script src="{{ asset('/plugins/summernote/summernote-bs4.min.js') }}"></script>
        <script type="text/javascript" >
            $(function () {
                // Summernote
                $('.textarea').summernote()
            })
            $('input[type="file"]').change(function(e){
                var fileName = e.target.files[0].name;
                $('.custom-file-label').html(fileName);
            });
            const $seleccionArchivos = document.querySelector("#imagenR"),
                $imagenPrevisualizacion = document.querySelector("#im");
            $seleccionArchivos.addEventListener("change", () => {

                const archivos = $seleccionArchivos.files;
                if (!archivos || !archivos.length) {
                    $imagenPrevisualizacion.src = "";
                    return;
                }
                const primerArchivo = archivos[0];
                const objectURL = URL.createObjectURL(primerArchivo);
                $imagenPrevisualizacion.src = objectURL;
            });
            $('.my-colorpicker1').colorpicker()
        </script>
    @endpush

