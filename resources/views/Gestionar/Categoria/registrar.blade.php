@extends('layout.plantilla')
@section('contenido') 
  <div class="card">
  <div class="card-header">
    <h3 >Registrar categoria</h3>
  </div>
  <div class="card-body p-5">
  @if(count($errors) > 0)
    <div class="errors ">
      <ul class="alert alert-danger " role="alert"><i class="fas fa-exclamation-triangle"></i> Mensaje informativo : <br>
      @foreach($errors->all() as $error)
        <li class="m-3">{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif
    <form action="{{url('/categoria/registrar')}}"  method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
      <label >Nombre de la categoria :</label>
      <input name="nombre" value="{{ old('nombre') }}" type="text" class="form-control">
      </div>
      <div class="form-group">
        <label>Color picker:</label>
        <input type="color" name="color" value="{{ old('color') }}" class="form-control ">
      </div>
      <div class="form-group">
      <label >Descripción :</label>
        <textarea name="descripcion" class="textarea" value=""  
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('descripcion') }}</textarea>
      </div>

      <div class="form-group row">
          <label >Imagen :</label>
          <div class="col mt-2 col">
                            <input type="file" name='imagen' value="{{ old('imagen') }}" class="custom-file-input mt-3 form-control-sm" id="imagenR" placeholder="df" accept="image/*">
                            <label  class="custom-file-label" for="imagenR">Seleccione una imagen</label>
                          </div>
          <div class="col">
            <label style="" class="form-group ">Vista previa :</label><br>
                        <img src="" id="im" style="width:150px; height: 150px;">
          </div>
      
      </div>
      <div class="form-group  row">
        <div class="col-4 "><a href="{{ url('/categoria/listar') }}" class="btn btn-outline-danger w-100"> ATRAS</a></div>
        <div class="col-4 "> <button type="submit" class="btn btn-outline-success w-100"> Registrar</button></div>
      </div>
      </div>

 
    </form>

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