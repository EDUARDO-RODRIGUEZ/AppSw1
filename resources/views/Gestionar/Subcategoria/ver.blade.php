@extends('layout.plantilla')
@section('contenido') 
  <div class="card">
  <div class="card-header">
    <h3 >Ver subcategoria</h3>
  </div>
  <div class="card-body p-5">

 
      
      <div class="form-group">
      <label >Nombre de la subcategoria :</label>
      <input disabled="true" name="nombre" value="{{ $subcategoria->nombre }}" type="text" class="form-control">
      </div>
      <div class="form-group">
        <label>Color picker:</label>
        <input disabled="true" type="color" name="color" value="{{ $subcategoria->color }}" class="form-control">
      </div>
      <div class="form-group">
      <label >Descripción :</label>
                        <textarea name="descripcion" class="textarea" value=""  
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! htmlspecialchars_decode( $subcategoria->descripcion)!!}</textarea>
      </div>

      <div class="form-group row">
          <label >Imagen :</label>
          <div class="col mt-2 col">
                            <input disabled="true" type="file" name='imagen' value="" class="custom-file-input mt-3 form-control-sm" id="imagenR" placeholder="df" accept="image/*">
                            <label  class="custom-file-label" for="imagenR">{{ $subcategoria->imagen }}</label>
                          </div>
          <div class="col">
            <label disabled="true" style="" class="form-group ">Vista previa :</label><br>
                        <img disabled="true" src="{{ '/storage/productos/'.$subcategoria->imagen }}"id="im" style="width:150px; height: 150px;">
          </div>
      
      </div>
      <div class="form-group w-50">
        <div class="col-4 "><a href="{{ url('/subcategoria/listar') }}" class="btn btn-outline-danger w-100"> ATRAS</a></div>
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