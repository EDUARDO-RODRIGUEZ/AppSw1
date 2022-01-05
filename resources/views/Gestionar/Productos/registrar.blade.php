@extends('layout.plantilla')
    @section('contenido')
        <div class="card">
            <h1 class="card-header">
                {{ "Registrar Producto para ".auth()->user()->usuarioempresa->empresa->nombre }}
            </h1>
            <div class="card-body">
                <div class="container">
                    @if(count($errors) > 0)
                        <div class="errors">
                            <ul class="alert alert-danger " role="alert">
                                <i class="fas fa-exclamation-triangle"></i> Mensaje informativo : <br>
                                @foreach($errors->all() as $error)
                                    <li class="m-3">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('productos.registrar') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                           value="{{ old('nombre') }}">
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label>
                                    <textarea type="text" class="form-control"
                                              id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="stock">Stock</label>
                                        <input type="number" class="form-control" id="stock" name="stock"
                                               value="{{ old('stock') }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="precio">Precio</label>
                                        <input type="number" class="form-control" id="precio" name="precio"
                                               value="{{ old('precio') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="subcategoria">Subcategoria</label>
                                        <select id="subcategoria" class="form-control" name="subcategoria">
                                            <option selected disabled>Elija una subcategoria...</option>
                                            @foreach($subcategorias as $subcategoria)
                                                <option value="{{ $subcategoria->id }}">{{ ($subcategoria->categoria->nombre).' : ' }} <span class="font-weight-bolder">{{ $subcategoria->nombre }}</span></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-8">
                                        <label for="imagen">Imagen :</label>
                                        <div class="col-8 mt-2">
                                            <input type="file" name="imagen"
                                                   value="{{ old('imagen') }}" class="custom-file-input mt-3 form-control-sm"
                                                   id="imagenR" placeholder="df" accept="image/*">
                                            <label class="custom-file-label" for="imagenR">Seleccione una imagen</label>
                                        </div>
                                    </div>
                                    <div class="col-4 justify-content-center">
                                        <label style="" class="form-group ">Vista previa :</label>
                                        <img alt src="" id="im" style="width:300px; height:300px;">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-1">
                                        <label for="">Confirmar: </label>
                                    </div>
                                    <div class="col-3">
                                        <a href="{{ route('productos.listar') }}"
                                           class="btn btn-outline-danger w-100">Cancelar</a>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-outline-success w-100"> Aceptar</button>
                                    </div>
                                </div>
                            </form>
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
