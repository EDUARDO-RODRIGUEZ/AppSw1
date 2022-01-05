@extends('layout.plantilla')
@section('contenido')
<div class="card">
    <div class="card-header">
        <h3>
            Editar categoria
        </h3>
    </div>
    <div class="card-body p-5">
        @if(count($errors) > 0)
        <div class="errors ">
            <ul class="alert alert-danger " role="alert">
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
        <form action="{{url('/categoria/editar/'.$categoria->id)}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-group">
                <label>
                    Nombre de la categoria :
                </label>
                <input class="form-control" name="nombre" type="text" value="{{ $categoria->nombre }}">
                </input>
            </div>
            <div class="form-group">
                <label>
                    Color picker:
                </label>
                <input class="form-control" name="color" type="color" value="{{ $categoria->color }}">
                </input>
            </div>
            <div class="form-group">
                <label>
                    Descripción :
                </label>
                <textarea class="textarea" name="descripcion" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" value="">
                    {!! htmlspecialchars_decode( $categoria->descripcion)!!}
                </textarea>
            </div>
            <div class="form-group row">
                <label>
                    Imagen :
                </label>
                <div class="col mt-2 col">
                    <input accept="image/*" class="custom-file-input mt-3 form-control-sm" id="imagenR" name="imagen" placeholder="df" type="file" value="">
                        <label class="custom-file-label" for="imagenR">
                            {{ $categoria->imagen }}
                        </label>
                    </input>
                </div>
                <div class="col">
                    <label class="form-group " style="">
                        Vista previa :
                    </label>
                    <br>
                        <img id="im" src="{{ '/storage/productos/'.$categoria->imagen }}" style="width:150px; height: 150px;">
                        </img>
                    </br>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-4 ">
                    <a class="btn btn-outline-danger w-100" href="{{ url('/categoria/listar') }}">
                        ATRAS
                    </a>
                </div>
                <div class="col-4 ">
                    <button class="btn btn-outline-success w-100" type="submit">
                        Registrar
                    </button>
                </div>
            </div>
        </form>
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
