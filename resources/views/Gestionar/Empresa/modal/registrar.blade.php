		 <div class="modal fade " id="registrarUsuario" >
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header" style="background: #BAB8C7;">
                <h4 class="modal-title ">Registrar nueva categoria</h4>
                <button type="button" class="close" data-dismiss ="modal" aria-label="Close">
                <span aria-hidden="true" >&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                  <div id="erroresR">
                  </div>
                <div class="card p-3">

                	<form id="registrarFormulario">
                    @csrf
                    <div class="input-group mb-3">
                      
                      <input id="nombreR" type="text" class="form-control" name="nombre" required  autofocus placeholder="Nombre de categoria" >
                      <div id="spann" class="">
                        <div id="nom" class="m-2">
                        </div>
                      </div>
                    </div>
                    <div class="input-group mb-3">
                      <textarea class="form-control" id="descripcionR" name="descripcion" placeholder="Descripcion de categoria" rows="3"></textarea>
                      <div class="" id="spand">
                        <div id="det" class="m-2">
                        </div>
                      </div>
                    </div>
                    <div class="form-row px-3 py-3">
                     	<button id="registrar" type="submit" class="btn btn-outline-primary registrarCategoria" > Registrar</button>
                      <button id="guardar" type="submit" class="btn btn-outline-primary registrarCategoria" > Guardar</button>
                     	<button class="btn btn-outline-warning mr-3
                      ml-4" type="reset" style=""><i class="fas fa-reply"></i> Reiniciar</button>
                    </div>   
                    </form>                            
                </div>  
            </div>
          </div>
        </div>
      </div>
