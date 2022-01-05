@extends('layout.plantilla')
@section('contenido') 
  <div class="card">
  <div class="card-header">
    <h3 >Editar empresa</h3>
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

    {{-- aqui lo registra --}}
    <form action="{{url('/empresa/editar/' . $empresa->id)}}"  method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
      <label >Nombre de la empresa :</label>
      <input name="nombre" value="{{$empresa->nombre}}" type="text" class="form-control">
      </div>
      <div class="form-group">
        <label>Descripción:</label>
        <textarea name="descripcion" class="textarea" value=""  
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$empresa->descripcion}}</textarea>
      </div>
      <div class="form-group">
      <div class="row">
        <div class="col"><label >Representante :</label>
          <input name="representante" value="{{$empresa->representante}}" type="text" class="form-control"></div>
        <div class="col"><div class="form-group">
        <label >Comisión :</label>
          <input name="comision" value="{{$empresa->comision}}" type="text" class="form-control">
        </div></div>
        


        
      </div>

      <div class="form-group">
      <label >Telefono :</label>
        <input name="telefono" value="{{$empresa->telefono}}" type="text" class="form-control">
      </div>

      <div class="form-group">
      <label >Direccion :</label>
        <input name="direccion" value="{{$empresa->direccion}}" type="text" class="form-control">
      </div>


      <div class="form-group row">
          <label >Imagen :</label>
          <div class="col mt-2 col">
                            <input type="file" name='imagen' value="" class="custom-file-input mt-3 form-control-sm" id="imagenR" placeholder="df" accept="image/*">
                            <label  class="custom-file-label" for="imagenR">{{$empresa->imagen}}</label>
                          </div>
          <div class="col">
            <label style="" class="form-group ">Vista previa :</label><br>
                        <img src="{{'/storage/empresas/'. $empresa->imagen}}" id="im" style="width:150px; height: 150px;">
          </div>
      
      </div>

      <div class="form-group  row">
        <div class="col-4 "><a href="{{ url('/empresa/listar') }}" class="btn btn-outline-danger w-100"> ATRAS</a></div>
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