@extends('layout.plantilla')
@section('contenido') 
  <div class="card">
  <div class="card-header">
    <h3 >Vista de usuario</h3>
  </div>
  <div class="card-body p-5">
  
      <div class="row">

        <div class="form-group col">
        <label >Nombres :</label>
        <input  disabled="true" name="name" value="{{ $usuario->name }}" type="text" class="form-control">
        </div>

        <div class="form-group col">
        <label >Apellidos :</label>
        <input  disabled="true" name="apellidos" value="{{ $usuario->apellidos }}" type="text" class="form-control">
        </div>
                
      </div>
      <div class="row">

        <div class="form-group col">
        <label >Email :</label>
        <input  disabled="true" name="email" value="{{$usuario->email }}" type="text" class="form-control">
        </div>
                
      </div>


      <div class="row">

        <div class="form-group col">
        <label >Carnet de identidad :</label>
        <input  disabled="true" name="ci" value="{{ $usuario->ci }}" type="text" class="form-control">
        </div>

        <div class="form-group col">
        <label >Fecha de nacimiento:</label>
        <input  disabled="true" name="fechanacimiento" value="{{ $usuario->fechanacimiento }}" type="date" class="form-control">
        </div>
        
        <div class="form-group col">
        <label >Sexo :</label>
          <select  disabled="true" class="form-control" name="sexo">
            @if($usuario->sexo == 1)
            <option selected="true" value="1">Masculino</option>
            <option value="2">Femenino</option>
            @else
            <option value="1">Masculino</option>
            <option selected="true" value="2">Femenino</option>
            @endif
            
          </select>
        </div>        
      
      </div>
      
      <div class="form-group row">

        <div class="form-group col">
        <label>Tel/Cel:</label>
        <input  disabled="true" type="text" name="telefono" value="{{ $usuario->telefono }}" class="form-control ">
        </div> 

      </div>
      
      <div class="form-group row">

        <div class="form-group col">
            <label >Imagen :</label>
              <div class="col mt-2 col">
              <input  disabled="true" type="file" name='imagen' value="" class="custom-file-input mt-3 form-control-sm" 
              id="imagenR" placeholder="df" accept="image/*">
              <label  class="custom-file-label" for="imagenR">{{ $usuario->imagen }}</label>
              </div>
            <div class="col">
              <label style="" class="form-group ">Vista previa :</label><br>
              <img src="{{ '/storage/productos/'.$usuario->imagen }}" id="im" style="width:150px; height: 150px;">
            </div>
        </div>
         
      </div>




        <div class="form-group  row">
        <div class="col-4 "><a href="{{ url('/super/listar') }}" class="btn btn-outline-danger w-100"> ATRAS</a></div>
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