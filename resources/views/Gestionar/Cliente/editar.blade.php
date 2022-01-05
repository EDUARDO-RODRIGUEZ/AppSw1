@extends('layout.plantilla')
@section('contenido') 
  <div class="card">
  <div class="card-header">
    <h3 >Editar usuario</h3>
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
    <form action="{{url('/usuario/editar/'.$usuario->id)}}"  method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">

        <div class="form-group col">
        <label >Nombres :</label>
        <input name="name" value="{{ $usuario->name }}" type="text" class="form-control">
        </div>

        <div class="form-group col">
        <label >Apellidos :</label>
        <input name="apellidos" value="{{ $usuario->apellidos }}" type="text" class="form-control">
        </div>
                
      </div>
      <div class="row">

        <div class="form-group col">
        <label >Email :</label>
        <input name="email" value="{{$usuario->email }}" type="text" class="form-control">
        </div>
                
      </div>
      <div class="row">

        <div class="form-group col">
        <label >Contraseña :</label>
        <input name="contraseña" value="" type="password" class="form-control">
        </div>

        <div class="form-group col">
        <label >Confirmar contraseña :</label>
        <input name="ccontraseña" value="" type="password" class="form-control">
        </div>
                
      </div>

      <div class="row">

        <div class="form-group col">
        <label >Carnet de identidad :</label>
        <input name="ci" value="{{ $usuario->ci }}" type="text" class="form-control">
        </div>

        <div class="form-group col">
        <label >Fecha de nacimiento:</label>
        <input name="fechanacimiento" value="{{ $usuario->fechanacimiento }}" type="date" class="form-control">
        </div>
        
        <div class="form-group col">
        <label >Sexo :</label>
          <select class="form-control" name="sexo">
            <option value="1">Masculino</option>
            <option value="2">Femenino</option>
          </select>
        </div>        
      
      </div>
      
      <div class="form-group row">

        <div class="form-group col">
        <label>Tel/Cel:</label>
        <input type="text" name="telefono" value="{{ $usuario->telefono }}" class="form-control ">
        </div> 

        <div class="form-group col">
        <label >Tipo de rol :</label>
        <select  class="form-control" name="idrol">
          <option value="">Seleccione un rol</option>
          <option value="2">Personal de una empresa</option>
          <option value="3">Repartidor de una empresa</option>
        </select>
        </div>
      </div>
      
      <div class="form-group row">

        <div class="form-group col">
            <label >Imagen :</label>
              <div class="col mt-2 col">
              <input type="file" name='imagen' value="" class="custom-file-input mt-3 form-control-sm" 
              id="imagenR" placeholder="df" accept="image/*">
              <label  class="custom-file-label" for="imagenR">{{ $usuario->imagen }}</label>
              </div>
            <div class="col">
              <label style="" class="form-group ">Vista previa :</label><br>
              <img src="{{ '/storage/productos/'.$usuario->imagen }}" id="im" style="width:150px; height: 150px;">
            </div>
        </div>
         
        <div class="form-group col">
        <label >Empresa :</label>
        <select  class="form-control" name="empresa">

          @foreach($empresas as $empresa)
          <option value="{{ $empresa->id}}">{{ $empresa->nombre }}</option>
          @endforeach
          
        </select>
        </div>
      </div>




      <div class="form-group w-50">
        <button type="submit" class="btn btn-outline-success"> Editar</button>
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