@extends('layout.plantilla')
    @section('contenido')
<div class="card">
    <h1 class="card-header">
        {{ "Editar Producto ".$producto->id." de empresa ".auth()->user()->usuarioempresa->empresa->nombre }}
    </h1>
    <div class="card-body">
        <div class="container">
            @if(count($errors) > 0)
            <div class="errors">
                <ul class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle">
                    </i>
                    Mensaje informativo :
                    <br>
                        @foreach($errors->all() as $error)
                        <li class="m-3">
                            {{ $error }}
                        </li>
                        @endforeach
                    </br>
                </ul>
            </div>
            @endif
            <div class="row">
                <div class="col">
                    <form action="{{ route('productos.actualizar', [$producto->id]) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                                @method('PUT')
                        <div class="form-group">
                            <label for="nombre">
                                Nombre
                            </label>
                            <input class="form-control" id="nombre" name="nombre" type="text" value="{{ $producto->nombre }}">
                            </input>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">
                                Descripcion
                            </label>
                            <textarea class="form-control" id="descripcion" name="descripcion" type="text">
                                {{ $producto->descripcion }}
                            </textarea>
                        </div>
                        <div class="form-row">
                            <input class="form-control" hidden="" id="stock" name="stock" readonly="" type="number" value="{{ $producto->stock }}">
                                <div class="form-group col-md">
                                    <label for="precio">
                                        Precio
                                    </label>
                                    <input class="form-control" id="precio" name="precio" type="number" value="{{ $producto->precio }}">
                                    </input>
                                </div>
                                <div class="form-group col-md">
                                    <label for="subcategoria">
                                        Subcategoria
                                    </label>
                                    <select class="form-control" id="subcategoria" name="subcategoria">
                                        <option disabled="" selected="">
                                            Elija una subcategoria...
                                        </option>
                                        @foreach($subcategorias as $subcategoria)
                                                @if($subcategoria->id == $producto->subcategoria->id)
                                        <option selected="" value="{{ $subcategoria->id }}">
                                            {{ ($subcategoria->categoria->nombre).' : ' }}
                                            <span class="font-weight-bolder">
                                                {{ $subcategoria->nombre }}
                                            </span>
                                        </option>
                                        @else
                                        <option value="{{ $subcategoria->id }}">
                                            {{ ($subcategoria->categoria->nombre).' : ' }}
                                            <span class="font-weight-bolder">
                                                {{ $subcategoria->nombre }}
                                            </span>
                                        </option>
                                        @endif
                                            @endforeach
                                    </select>
                                </div>
                            </input>
                        </div>
                        <div class="form-row">
                            <div class="col-8">
                                <label for="imagen">
                                    Imagen :
                                </label>
                                <div class="col-8 mt-2">
                                    <label class="custom-file-label" for="imagenR">
                                        Seleccione una imagen
                                    </label>
                                    <input accept="image/*" class="custom-file-input mt-3 form-control-sm" id="imagenR" name="imagen" placeholder="df" type="file" value="{{ $producto->imagen }}">
                                    </input>
                                </div>
                            </div>
                            <div class="col-4 justify-content-center">
                                <label class="form-group " style="">
                                    Vista previa :
                                </label>
                                <img alt="" id="im" src="{{ '/storage/images/productos/'.$producto->imagen }}" style="width:300px; height:300px;">
                                </img>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-1">
                                <label for="">
                                    Confirmar:
                                </label>
                            </div>
                            <div class="col-3">
                                <a class="btn btn-outline-danger w-100" href="{{ route('productos.listar') }}">
                                    Cancelar
                                </a>
                            </div>
                            <div class="col-3">
                                <button class="btn btn-outline-success w-100" type="submit">
                                    Editar
                                </button>
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
<script src="{{ asset('/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}">
</script>
<script src="{{ asset('/plugins/summernote/summernote-bs4.min.js') }}">
</script>
<script type="text/javascript">
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
