     <div class="modal fade " id="registrarUsuario" >
        <div class="modal-dialog ">
          <div class="modal-content ">
            <div class="modal-header" style="background: #BAB8C7;">
                <h4 class="modal-title" id="tituloR">Registrar nuevo usuario</h4>
                <button type="button" class="close" data-dismiss ="modal" aria-label="Close">
                <span aria-hidden="true" >&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                  <div id="erroresR" >
                  </div>

                <div class="card p-3">

                  <form  class="formulario" id="registrarFormulario" method="POST" enctype="multipart/form-data">
                    <div class="row ml-1">
                      <label style="font-weight: normal;">Nombre de usuario: :</label>
                    </div>
                    <div class="row ml-1">
                      <input id="nombreR" type="text" class="form-control form-control-sm" name="name"   autofocus placeholder="" >
                    </div>
                    <div class="row ml-1">
                      <label style="font-weight: normal;">Email :</label>
                    </div>
                    <div class="input-group mb-3">
                      <input id="emailR" type="email" class="form-control form-control-sm" name="email"   autofocus placeholder="" >
                      <div id="spann" class="">
                        <div id="nom" class="m-2">
                        </div>
                      </div>
                    </div>
                    <div class="row ml-1">
                      <label style="font-weight: normal;">Contraseña :</label>
                    </div>
                    <div class="input-group mb-3">
                      <input type="password" class="form-control form-control-sm" id="passwordR" name="contraseña" placeholder="Contraseña de usuario" >

                      <div class="" id="spand">
                        <div id="det" class="m-2">
                        </div>
                      </div>
                    </div>
                    <div class=" mr-1 row mb-3">
                      <div class="col">
                        <input type="password" placeholder="Confirmar contraseña" class="form-control form-control-sm" name="ccontraseña" id="cpasswordR">
                      </div>
                      
                    </div>
                    <div class="row mb-2 mx-1">
                      <label style="font-weight: normal;" for="representante" class="">Carnet de identidad : </label>
                      <div class="col">
                        <input class="form-control form-control-sm" type="text" name="ci" id="ciR">
                      </div>
                    </div>
                    <div class="row mx-1">
                      <label style="font-weight: normal;" for="representante" class="">Tel/Celular : </label>
                      <div class="col">
                        <input class="form-control form-control-sm" type="text" name="telefono" id="telefonoR">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <label>Tipo de usuario :</label>
                        <select id="tipoR" name="tipos" class="form-control select2" style="width: 100%;">
                          <option value="">--Seleccionar--</option>
                          <option value="1">Usuario administrador</option>
                          <option value="2">Usuario de empresa</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col" id="empresaid">
                        <label>Empresa :</label>
                        <select id="empresaR" name="empresas" class="form-control select2" style="width: 100%;">
                          <option value="">--Seleccionar--</option>
                          @foreach($empresas as $empresa)
                          <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div id="panel" class="form-row px-3 py-3">
                      <button id="registrar" type="submit" class="btn btn-primary registrarCategoria" > Registrar</button>
                      <button class="btn btn-primary mr-3
                      ml-4" type="reset" style=""><i class="fas fa-reply"></i> Borrar campos</button>
                    </div>

                    </form>                            
                </div>  
            </div>
          </div>
        </div>
      </div>


      
       <div class="modal fade " id="guardarUsuario" >
        <div class="modal-dialog ">
          <div class="modal-content ">
            <div class="modal-header" style="background: #BAB8C7;">
                <h4 class="modal-title" id="tituloR">Registrar nuevo usuario</h4>
                <button type="button" class="close" data-dismiss ="modal" aria-label="Close">
                <span aria-hidden="true" >&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                  <div id="erroresG" >
                  </div>

                <div class="card p-3">

                  <form  class="formulario" id="guardarFormulario" method="POST">
                    <div class="row ml-1">
                      <label style="font-weight: normal;">Nombre de usuario: :</label>
                    </div>
                    <div class="row">
                      <div class="input-group mb-3">
                          <input id="nombreG" type="text" class="form-control form-control-sm" name="name"   autofocus placeholder="" >
                    <div class="" id="spandG">
                        <div id="detG" class="m-2">
                        </div>
                    </div>
                    </div>
                  
                    <div class="row ml-1">
                      <label style="font-weight: normal;">Email :</label>
                    </div>
                    <div class="input-group mb-3">
                      <input id="emailG" type="email" class="form-control form-control-sm" name="email"   autofocus placeholder="" >
                      <div id="spann" class="">
                        <div id="nomG" class="m-2">
                        </div>
                      </div>
                    </div>
                    <div class="row ml-1">
                      <label style="font-weight: normal;">Contraseña :</label>
                    </div>
                    <div class="input-group mb-3">
                      <input type="password" class="form-control form-control-sm" id="passwordG" name="contraseña" placeholder="Contraseña de usuario" >


                      </div>
                    </div>
                    <div class=" mr-1 row mb-3">
                      <div class="col">
                        <input type="password" placeholder="Confirmar contraseña" class="form-control form-control-sm" type="text" name="password_confirmation" id="cpasswordG">
                      </div>
                      
                    </div>
                    <div class="row mb-2 mx-1">
                      <label style="font-weight: normal;" for="representante" class="">Carnet de identidad : </label>
                      <div class="col">
                        <input class="form-control form-control-sm" type="text" name="ci" id="ciG">
                      </div>
                    </div>
                    <div class="row mx-1">
                      <label style="font-weight: normal;" for="representante" class="">Tel/Celular : </label>
                      <div class="col">
                        <input class="form-control form-control-sm" type="text" name="telefono" id="telefonoG">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <label>Tipo de usuario :</label>
                        <select id="tipoG" name="tipos" class="form-control select2" style="width: 100%;">
                          <option value="">--Seleccionar--</option>
                          <option value="1">Usuario administrador</option>
                          <option value="2">Usuario de empresa</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col" id="empresaidG">
                        <label>Empresa :</label>
                        <select id="empresaG" name="empresas" class="form-control select2" style="width: 100%;">
                          <option value="">--Seleccionar--</option>
                          @foreach($empresas as $empresa)
                          <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div id="panelG" class="form-row px-3 py-3">
                      <button id="guardar" type="submit" class="btn btn-primary registrarCategoria" > Registrar</button>
                      <button class="btn btn-primary mr-3
                      ml-4" type="reset" style=""><i class="fas fa-reply"></i> Borrar campos</button>
                    </div>
                    </form>                            
                </div>  
            </div>
          </div>
        </div>
      </div>

          