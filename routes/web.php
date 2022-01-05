<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
//Login


Auth::routes();
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::get('/set_language/{lang}', 'Controller@setLanguage')->name('set_language');

Route::get('/', 'ClienteController@index')->middleware('estado', 'verificar')->name('home');

//usuario crud
//Route::get('/usuario/{id}/editar','UsuarioController@devolverDatos');
//Route::post('/usuario/{id}/guardar','UsuarioController@store');
//Route::post('/usuario/{id}/estado/{estado}','UsuarioController@cambiarEstado');
//Route::get('/usuario/inicio','UsuarioController@select');
//productos
Route::get('producto/detalle/{id}', 'ProductoController@listarDetalle');

Route::group(['prefix' => 'subcategoria'], function () {
    Route::get('{id}/productos', 'ProductoController@Listar');
});
Route::group(['prefix' => 'gestionar'], function () {
    Route::get('/categoria', function () {
        return view('administrarCategoria.categorias');
    });
    Route::get('/usuarios', 'UsuarioController@select');
});
Route::post('/usuarios/registrar', 'UsuarioController@Registrar');
Route::get('imagenes/{path}/{attachment}', function ($path, $attachment) {
    $file = sprintf('storage/%s/%s', $path, $attachment);
    if (File::exists($file)) {
        return \Intervention\Image\Facades\Image::make($file)->resize(200, 200)->response();
    }
});
Route::get('/prueba/{id}', 'UsuarioController@prueba');
//CRUD mostrar categorias a cliente
Route::get('/categorias', 'CategoriaController@listarCliente');

Route::get('/correo', 'UsuarioController@correo');
Route::get('/cliente/verificacion/{token}', 'UsuarioController@verificacion');

Route::get('/mensaje', function () {
    return view('modal.mensaje');
});

//CRUD categorias
Route::get('/categoria/listar', 'CategoriaController@listar');
Route::get('/categoria/formulario', 'CategoriaController@formularioRegistro');
Route::post('/categoria/registrar', 'CategoriaController@registrar');
Route::get('/categoria/devolverDatos/{id}', 'CategoriaController@devolverDatos');
Route::post('/categoria/editar/{id}', 'CategoriaController@editar');
Route::delete('/categoria/eliminar/{id}', 'CategoriaController@eliminar');
Route::get('/categoria/ver/{id}', 'CategoriaController@ver');
//CRUD subcategorias
Route::get('/subcategoria/listar', 'SubcategoriaController@listar')->name('listarSubategoria');
Route::get('/subcategoria/formulario', 'SubcategoriaController@formularioRegistro');
Route::post('/subcategoria/registrar', 'SubcategoriaController@registrar');
Route::get('/subcategoria/devolverDatos/{id}', 'SubcategoriaController@devolverDatos');
Route::post('/subcategoria/editar/{id}', 'SubcategoriaController@editar');
Route::delete('/subcategoria/eliminar/{id}', 'SubcategoriaController@eliminar');
Route::get('/subcategoria/ver/{id}', 'SubcategoriaController@ver');
//CRUD usuarios
Route::get('/usuario/listar', 'UsuarioController@listar');
Route::get('/usuario/formulario', 'UsuarioController@formularioRegistro');
Route::post('/usuario/registrar', 'UsuarioController@registrar');
Route::get('/usuario/devolverDatos/{id}', 'UsuarioController@devolverDatos');
Route::post('/usuario/editar/{id}', 'UsuarioController@editar');
Route::get('/usuario/{id}/estado/{estado}', 'UsuarioController@cambiarEstado');
Route::delete('/usuario/eliminar/{id}', 'UsuarioController@eliminar');
Route::get('/usuario/ver/{id}', 'UsuarioController@ver');

Route::get('/register/verify/{codigo}', 'UsuarioController@verificar');
//CRUD clientes
Route::get('/cliente/listar', 'ClienteController@listar');
Route::get('/cliente/formulario', 'ClienteController@formularioRegistro');
Route::post('/cliente/registrar', 'ClienteController@registrar');
Route::get('/cliente/devolverDatos/{id}', 'ClienteController@devolverDatos');
Route::post('/cliente/editar/{id}', 'ClienteController@editar');
Route::get('/cliente/{id}/estado/{estado}', 'ClienteController@cambiarEstado');
Route::get('/cliente/ver/{id}', 'ClienteController@ver');

//CRUD bitacora
Route::get('/bitacora/listar', 'BitacoraController@listar');

//CRUD para los superadministradores superadministrador
Route::get('/super/listar', 'SuperController@listar');
Route::get('/super/formulario', 'SuperController@formularioRegistro');
Route::post('/super/registrar', 'SuperController@registrar');
Route::get('/super/devolverDatos/{id}', 'SuperController@devolverDatos');
Route::post('/super/editar/{id}', 'SuperController@editar');
Route::delete('/super/eliminar/{id}', 'SuperController@eliminar');
Route::get('/super/ver/{id}', 'SuperController@ver');
//CRUD gestionar direccion
Route::get('/direccion/listar', 'DireccionController@listar');
Route::get('/direccion/formulario', 'DireccionController@formularioRegistro');
Route::post('/direccion/registrar', 'DireccionController@registrar');
Route::get('/direccion/devolverDatos/{id}', 'DireccionController@devolverDatos');
Route::post('/direccion/editar/{id}', 'DireccionController@editar');
Route::delete('/direccion/eliminar/{id}', 'DireccionController@eliminar');
//CRUD gestionar direccion
Route::get('/empresa/listar', 'EmpresaController@listar');
Route::get('/empresa/formulario', 'EmpresaController@formularioRegistro');
Route::post('/empresa/registrar', 'EmpresaController@registrar');
Route::get('/empresa/devolverDatos/{id}', 'EmpresaController@devolverDatos');
Route::post('/empresa/editar/{id}', 'EmpresaController@editar');
Route::delete('/empresa/eliminar/{id}', 'EmpresaController@eliminar');
//Caso de uso realizar cobro
Route::post('/realizarCobro/{id}', 'CobroController@cobrar');
//Gestionar cobro
Route::get('/cobro/listar', 'CobroController@listar');
//CRUD gestionar rol
Route::get('/rol/listar', 'RolController@listar');
Route::get('/rol/formulario', 'RolController@formularioRegistro');
Route::post('/rol/registrar', 'RolController@registrar');
Route::get('/rol/devolverDatos/{id}', 'RolController@devolverDatos');
Route::post('/rol/editar/{id}', 'RolController@editar');
Route::delete('/rol/eliminar/{id}', 'RolController@eliminar');
//Asignar direccion
Route::get('/asignarDireccion/listar', 'DireccionController@listarDireccion');
Route::get('/asignarDireccion/asignar/{id}', 'DireccionController@asignar');

//Realizar resena
Route::get('/realizarRevision/form/{id}', 'RevisionController@formulario');
Route::post('/realizarRevision/{id}', 'RevisionController@valorar');

//Productos
Route::get('productos/listar', 'ProductoController@listarP')->name('productos.listar');
Route::get('productos/crear', 'ProductoController@crear')->name('productos.crear');
Route::post('productos/registrar', 'ProductoController@registrar')->name('productos.registrar');
Route::get('productos/{id}', 'ProductoController@ver')->name('productos.ver');
Route::get('productos/{id}/editar', 'ProductoController@editar')->name('productos.editar');
Route::put('productos/{id}', 'ProductoController@actualizar')->name('productos.actualizar');
Route::delete('productos/{id}', 'ProductoController@eliminar')->name('productos.eliminar');
Route::get('productos/{id}/aumentarStock', 'ProductoController@aumentarStock')->name('productos.aumentarStock');
Route::put('productos/actualizarStock/{id}', 'ProductoController@actualizarStock')->name('productos.actualizarStock');

//Pedidos
Route::get('pedidos/listar', 'PedidoController@listar')->name('pedidos.listar');
Route::get('pedidos/{id}/{estado}', 'PedidoController@cambiarEstado')->name('pedidos.cambiarEstado');
Route::get('pedido/{id}/asignarRepartidor', 'PedidoController@asignarRepartidor')->name('pedidos.asignarRepartidor');
Route::get('pedidos/guardarRepartidor/{id}/{idrepartidor}', 'PedidoController@guardarRepartidor')
    ->name('pedidos.guardarRepartidor');

//Detalle de Pedidos
Route::get('detallePedidos/listar', 'DetallePedidosController@listar')->name('detallePedidos.listar');
Route::get('detallePedidos/{id}', 'DetallePedidosController@detalleDePedido')->name('detallePedidos.mostrar');
//Realizar pedido

Route::post('/realizarPedido/agregarCarrito', 'ProductoController@agregarCarrito');
Route::get('pruebitas', 'ProductoController@indexCarrito');

Route::get('realizarPedido/carrito', 'PedidoController@retornarCarrito');
Route::get('realizarPedido/vaciar', 'PedidoController@vaciarCarrito');
Route::get('realizarPedido/eliminar/{id}', 'PedidoController@eliminarProducto');
Route::post('realizarPedido/actualizar', 'PedidoController@stockProducto');
Route::post('realizarPedido/finalizarPedido', 'PedidoController@finalizarPedido');
Route::get('realizarPedido/formularioDireccion', 'PedidoController@retornarFormulario');
Route::post('realizarPedido/formularioMetodoPago', 'PedidoController@guardarDireccion');
Route::get('realizarPedido/MetodoPago', 'PedidoController@retornarMetodoPago');

//CRUD productos
Route::get('/producto/inicio', 'ProductoController@inicio');
Route::get('/empresa/producto/inicio', 'ProductoController@inicioEmpresa');
Route::get('/producto/inicio/dataTable', 'ProductoController@listarProductos');
Route::get('/empresa/producto/inicio/dataTable', 'ProductoController@listarProductosDeEmpresa');
Route::post('/producto/registrar', 'ProductoController@Registrar');
Route::get('/producto/{id}/devolverDatos', 'ProductoController@devolverDatos');
Route::post('/producto/{id}/guardar', 'ProductoController@guardar');
//CRUD empresas
Route::get('/empresa/inicio', 'EmpresaController@inicio');
Route::get('/empresa/inicio/dataTable', 'EmpresaController@listarEmpresas');
Route::post('/empresa/registrar', 'EmpresaController@registrar');
Route::get('/empresa/{id}/devolverDatos', 'EmpresaController@devolverDatos');
Route::post('/empresa/{id}/guardar', 'EmpresaController@guardar');
Route::post('/empresa/{id}/estado/{estado}', 'EmpresaController@cambiarEstado');
//CRUD empresa promocion
Route::get('/empresa/promocion/inicio', 'PromocionController@inicioEmpresa');
Route::get('/empresa/promocion/inicio/dataTable', 'PromocionController@listarPromociones');
Route::post('/empresa/promocion/registrar', 'PromocionController@registrar');
Route::get('/empresa/promocion/{id}/devolverDatos', 'PromocionController@devolverDatos');
Route::post('/empresa/promocion/{id}/guardar', 'PromocionController@guardar');
Route::post('/empresa/promocion/{id}/estado/{estado}', 'PromocionController@cambiarEstado');

//cliente
Route::get('cliente', 'ClienteController@index');
Route::post('cliente/login', 'ClienteController@login');
Route::post('cliente/salir', 'ClienteController@salir');
//pedido cliente
Route::get('/gestionarPedido/cliente', 'PedidoController@indicePedido');
//direccion cliente
Route::get('gestionarDireccion/cliente', 'DireccionController@indiceDireccion');
