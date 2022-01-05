

<template>
			 <div>
	          <div class="card p-3">
              <div class="card-header">
                <h2 class="card-title"> <strong>Lista de categorias</strong></h2>
				<div class="text-right">
					<button class="btn btn-outline-secondary" data-toggle="modal" data-target="#dayler" @click="abrirModal('categoria','registrar')"><i class="fas fa-plus "></i>  Agregar</button>
				</div>
                <div class="card-body">
                <table id="table_id"  class="table table-striped table-bordered " style="width:100%">
                  <thead>
                    <tr>
                      <th style="width: 40px" class="text-center">Id</th>
                      <th style="width: 100px">Nombre</th>
                      <th >Descripcion</th>
                      <th style="width: 110px">Estado</th>
                      <th style="width: 40px">Cambiar estado</th>
                      <th style="width: 40px">Eliminar</th>
                    </tr>
                  </thead>
                  
                  <tfoot>
                  <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Estado</th>
                  <th>Cambiar estado</th>
                  <th>Eliminar</th>
                  </tr>
                  </tfoot>
                </table>
                  
              </div>
             
 
              </div>
              <!-- /.card-header -->
            </div>
			 <div class="modal fade " id="dayler" >
                  <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header bg-cyan">
                            <h4 class="modal-title ">Registrar nueva categoria</h4>
                            <button type="button" class="close" @click="cerrarModal()" data-dismiss ="modal" aria-label="Close">
                            <span aria-hidden="true" >&times;</span>
                            </button>
                        </div>

                        <div class="modal-body ">
                              <p class="login-box-msg"> </p>
                            <div class="card p-3">
                            	<form v-on:submit.prevent="onSubmit">
                                @csrf
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" v-text="nombre" v-model="nombre" name="nombre" required  autofocus placeholder="Nombre de categoria" >
                                  <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-envelope"></span>
                                    </div>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control " v-text="descripcion" v-model="descripcion" name="descripcion" required  placeholder="descipcion ">
                                     
                                  <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                    </div>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                  <input type="number" class="form-control " name="password"  placeholder="Password">
                                     
                                  <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-row px-3">
                                 	<button  class="btn btn-success mr-3" v-if="tipoaccion ==true" style="color:white" @click="registrarCategoria()" v-bind:data-dismiss="variable2"><i class="fas fa-check"></i> Registrar</button>
                                  <button  class="btn btn-success mr-3" v-if="tipoaccion == false" style="color:white" @click="actualizarCategoria()" v-bind:data-dismiss="variable2"><i class="fas fa-check"></i> Actualizar</button>
                                 	<button class="btn btn-warning  mr-3" type="reset" style="color:white"><i class="fas fa-reply"></i> Reiniciar</button>
                                 	<button class="btn btn-danger"  data-dismiss ="modal" style="color:white" ><i class="fas fa-sign-out-alt"></i>Salir</button>
                                </div>   
                                </form>                            
                            </div>  
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
		</div>      
  
		
</template>


<style scoped>
			.modal-content{
				width: 100% !important;
				position: absolute !important;
			}
			.mostrar{
				display : list-item !important;
				opacity : 1 !important;
				position : absolute !important ;
				background-color : #3c29297a !important;
			}
</style>

 
<script> 
          
	    export default {
        data(){
        	return {
            id:0,
        		nombre: '',
        		descripcion:'',
            estado:'',
        		arrayCategoria:[],
        		tituloModal :'',
        		variable2 :'',
            errorCategoria :false,
            errorMostrarMsjCategoria:[],
            tipoaccion : true
        	}
        },
        methods : {
        
        	listarCategoria(){
        		let me = this;
				axios.get('/categoria').then(function (response) {
				// handle success
					me.arrayCategoria = response.data;
				})
				.catch(function (error) {
				// handle error
				console.log(error);
				})
				.then(function () {
				// always executed
				});

        	},validarCategoria(){
            if(this.nombre == ''){
              this.errorMostrarMsjCategoria.push('El nombre de la categoria no es valido');
            }
            if(this.descripcion == ''){
              this.errorMostrarMsjCategoria.push('La descripcion de la categoria no es valido');
            }
            if(this.errorMostrarMsjCategoria.length >=1){
                this.errorCategoria=true;
            }
            return this.errorCategoria;
          },
        	cerrarModal(){
        		this.variable2 ='';
            this.tipoaccion=true;
            this.errorCategoria=false;
            this.errorMostrarMsjCategoria=[];
        	},
        	registrarCategoria(){
      				let me = this;
      				if(me.validarCategoria()==true){
                me.cerrarModal();
                return 0;
      				}
               this.variable2 ='modal';

      				axios.post('/categoria/registrar',{
      					'nombre' : this.nombre ,
      					'descripcion' : this.descripcion

      				}).then(function (response) {
      				// handle success
      					me.listarCategoria();
      					me.cerrarModal();
      				})
      				.catch(function (error) {
      				// handle error
      				console.log(error);
      				})
      				.then(function () {
      				// always executed
      				});
				
        	},
          mostrarSweet(){
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: '¿ Esta seguro de anular la Categoria?',
                text: "La publicacion se quitará del menu!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, quitar del menu!',
                cancelButtonText: 'No, cancelar operación!',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;
                    axios.put('/categoria/desactivar',{

                      'id' : this.id
                    }).then(function (response) {
                    // handle success
                      me.listarCategoria();
                      me.cerrarModal();
                    })
                    .catch(function (error) {
                    // handle error
                    console.log(error);
                    })
                    .then(function () {
                    // always executed
                    });                
                swalWithBootstrapButtons.fire(
                'Operación finalizada!',
                'La categoria se elimino del menú',
                'success'
                )

                } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
                ) {

                swalWithBootstrapButtons.fire(
                'Operación cancelada',
                'La categoria se restauró',
                'error'
                )
                }
                })
          }
          ,actualizarCategoria(){
              let me = this;
              if(me.validarCategoria()==true){
                me.cerrarModal();
                return 0;
              }
               this.variable2 ='modal';

              axios.put('/categoria/actualizar',{
                'nombre' : this.nombre ,
                'descripcion' : this.descripcion,
                'id' : this.id
              }).then(function (response) {
              // handle success
                me.listarCategoria();
                me.cerrarModal();
              })
              .catch(function (error) {
              // handle error
              console.log(error);
              })
              .then(function () {
              // always executed
              });
        
          },abrirModal(modelo,accion,data=[]){
        		switch (modelo) {
        			case "categoria":{
        				switch (accion) {
        					case "registrar":{
        						// statements_1
        						this.variable2='';
        						this.nombre ='';
        						this.descripcion='';
        						break;}
        					case "actualizar":{
                    this.variable2='';
                    this.tipoaccion=false;
                    this.nombre =data['nombre'];
                    this.descripcion=data['descripcion'];
                    this.id=data['id'];
                    break;
        					}
                  case "eliminar":{
                    let me = this;
                    this.variable2='';
                    this.tipoaccion=false;
                    this.nombre =data['nombre'];
                    this.descripcion=data['descripcion'];
                    this.id=data['id'];
                    me.mostrarSweet();
                    break;
                  }
        				}
        			}
        			
        		}
        	}
        },
        mounted() {
            this.listarCategoria();
        }
    }
</script>

