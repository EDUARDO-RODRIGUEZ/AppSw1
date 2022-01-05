@extends('layout.plantilla')
@section('contenido')
  <div class="card">
  <div class="card-header">
    <h3 >Valoración de pedido</h3>
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
    <form action="{{url('/realizarRevision/'.$id)}}"  method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group container">
      <label >Porfavor, ingrese una calificación al pedido :</label>
      <br>
      <br>
        <div class="row">
          <div class="col"><ul class="rating-stars">
              <li  class="stars-active">
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
              </li>
              <li>
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
              </li>
            </ul>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="valoracion" id="inlineRadio1" value="5">
              <label class="form-check-label" for="inlineRadio1">Muy bueno</label>
            </div>
          </div>
          <div class="col"><ul class="rating-stars">
              <li  class="stars-active">
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
              </li>
              <li>
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
              </li>
            </ul>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="valoracion" id="inlineRadio2" value="4">
              <label class="form-check-label" for="inlineRadio2">Bueno</label>
            </div>
          </div>
          <div class="col"><ul class="rating-stars">
              <li  class="stars-active">
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
              </li>
              <li>
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
              </li>
            </ul>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="valoracion" id="inlineRadio3" value="3">
              <label class="form-check-label" for="inlineRadio3">Regular</label>
            </div>
          </div>
          <div class="col"><ul class="rating-stars">
              <li  class="stars-active">
                <i class="fa fa-star"></i><i class="fa fa-star"></i>
              </li>
              <li>
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
              </li>
            </ul>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="valoracion" id="inlineRadio4" value="2">
              <label class="form-check-label" for="inlineRadio4">Malo</label>
            </div>
          </div>
          <div class="col"><ul class="rating-stars">
              <li  class="stars-active">
                <i class="fa fa-star"></i>
              </li>
              <li>
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
              </li>
            </ul>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="valoracion" id="inlineRadio4" value="1">
              <label class="form-check-label" for="inlineRadio4">Muy malo</label>
            </div>
          </div>

        </div>
        <br>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Porfavor, envianos tu opinón :</label>
          <br>
          <textarea name="reseña" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>

      </div>

      <div class="form-group  row">
        <div class="col-4 "><a href="{{ url('/gestionarPedido/cliente') }}" class="btn btn-outline-danger w-100"> ATRAS</a></div>
        <div class="col-4 "> <button type="submit" class="btn btn-outline-success w-100"> GUARDAR VALORACIÓN</button></div>
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