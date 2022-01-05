@extends('layout.plantilla')
@section('contenido') 
  <div class="card">
  <div class="card-header">
    <h3 >Registrar rol</h3>
  </div>
  <div class="card-body p-5">
    @if(Session::has('flash_message'))
      <div class="px-2"><div class="alert alert-danger"><span class="glyphicon glyphicon-ok"></span> {!! session('flash_message') !!}</div></div>
       
      @endif
  @if(count($errors) > 0)
    <div class="errors ">
      <ul class="alert alert-danger " role="alert"><i class="fas fa-exclamation-triangle"></i> Mensaje informativo : <br>
      @foreach($errors->all() as $error)
        <li class="m-3">{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif
    <form action="{{url('/rol/registrar')}}"  method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
      <label >Nombre del rol :</label>
      <input name="nombre" value="{{ old('nombre') }}" type="text" class="form-control">
      </div>
      <div class="form-group">
        <label>Descripción :</label>
        <input type="text" name="descripcion" value="{{ old('descripcion') }}" class="form-control ">
      </div>

      <div class="row">
          <div class="col">
            <label >Acciones :</label>
            <div class="p-3 form-group border">
            
                <div class="pb-3 custom-control custom-checkbox">
                  <input name="producto" value="1" type="checkbox" class="custom-control-input gestionar" id="customCheck1">
                  <label class="custom-control-label" for="customCheck1"><h5><span class="badge badge-secondary">Gestionar producto</span></h5></label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input name="pedido" value="2" type="checkbox" class="custom-control-input gestionar" id="customCheck2">
                  <label class="custom-control-label" for="customCheck2"><h5><span class="badge badge-secondary">Gestionar pedido</span></h5></label>
                </div>
            </div>
          </div>

          <div class="col">
            <label >Privilegios :</label>
            <div class="p-3 form-group border">
              {{-- Privilegios cualquier gestionar --}}
              <div id="listar" class="row  d-flex justify-content-around">
                <div class="pb-3 custom-control custom-checkbox">
                  <input  checked="true" disabled="true" type="checkbox" class="custom-control-input" id="customCheck3">
                  <label  class="custom-control-label" for="customCheck3"><h5><span class="badge badge-secondary">Listar y ver a detalle</span></h5></label>
                  </div>
              </div>
              <div id="checkGestionar">
                <div class="row d-flex justify-content-around">
                  
                  <div class="custom-control custom-checkbox">
                    <input name="privilegio[0]" value="2" type="checkbox" class="custom-control-input gestion" id="customCheck4">
                    <label class="custom-control-label" for="customCheck4"><h5><span class="badge badge-primary">Buscar</span></h5></label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input name="privilegio[1]" value="3" type="checkbox" class="custom-control-input gestion" id="customCheck5">
                    <label class="custom-control-label" for="customCheck5"><h5><span class="badge badge-info">Registrar</span></h5></label>
                  </div>
                  
                  
                </div>
                <div class="mb-1 row d-flex justify-content-around">
                  <div class="custom-control custom-checkbox">
                    <input name="privilegio[2]" value="4" type="checkbox" class="custom-control-input gestion" id="customCheck6">
                    <label class="custom-control-label" for="customCheck6"><h5><span class="badge badge-warning">Editar</span></h5></label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input name="privilegio[3]" value="5" type="checkbox" class="custom-control-input gestion" id="customCheck7">
                    <label class="custom-control-label" for="customCheck7"><h5><span class="badge badge-danger">Eliminar</span></h5></label>
                  </div>
                </div>
              </div>
               {{--  Privilegios para gestionar pedido --}}
                <div id="checkPedido" class="pt-2 row d-flex justify-content-around border">
                  <div class="custom-control custom-checkbox">
                    <input name="privilegio[4]" value="6" type="checkbox" class="custom-control-input pedido" id="customCheck8">
                    <label class="custom-control-label" for="customCheck8"><h5><span class="badge badge-light">Asignar repartidor</span></h5></label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input name="privilegio[5]" value="7" type="checkbox" class="custom-control-input pedido" id="customCheck9">
                    <label class="custom-control-label" for="customCheck9"><h5><span class="badge badge-light">Cambiar estado</span></h5></label>
                  </div>
                  
                </div>
                
            </div>

          </div>

      </div>

      
      
      
      <div class="form-group  row">
        <div class="col-4 "><a href="{{ url('/rol/listar') }}" class="btn btn-outline-danger w-100"> ATRAS</a></div>
        <div class="col-4 "> <button type="submit" class="btn btn-outline-success w-100"> REGISTRAR</button></div>
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
      $('#checkGestionar').fadeTo("slow", 0.1);
      $('#checkPedido').fadeTo("slow", 0.1);
      $('#listar').fadeTo("slow", 0.1);
      $('.gestionar').change(function(){
        
          if($('#customCheck1').prop('checked') && $('#customCheck2').prop('checked')){
            $('#checkGestionar').fadeTo("slow", 1);
            $('#checkPedido').fadeTo("slow", 1);  
            $('#listar').fadeTo("slow", 1);  
          }
          else{
            if( $('#customCheck1').prop('checked') ) {
              $('#checkGestionar').fadeTo("slow", 1);
              $('#listar').fadeTo("slow", 1);  
            }
            if(! $('#customCheck1').prop('checked') ) {
              $('#checkGestionar').fadeTo("slow", 0.1);
              $(".gestion").prop("checked", false);  
            }
            if( $('#customCheck2').prop('checked') ) {
              $('#checkPedido').fadeTo("slow", 1);
              $('#listar').fadeTo("slow", 1);  
            }
            if(! $('#customCheck2').prop('checked') ) {
              $('#checkPedido').fadeTo("slow", 0.1);
              $(".pedido").prop("checked", false); 
            }
          }
          if(!$('#customCheck1').prop('checked') && !$('#customCheck2').prop('checked')){
            $('#checkGestionar').fadeTo("slow", 0.1);
            $('#checkPedido').fadeTo("slow", 0.1);  
            $('#listar').fadeTo("slow", 0.1); 
            $(".gestion").prop("checked", false);
            $(".pedido").prop("checked", false);
          }

          
        
      });
      







  
  </script>
@endpush