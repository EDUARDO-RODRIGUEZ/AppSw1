<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Empresa;
use App\Http\Requests\ProductosRequest;
use App\Producto;
use App\Rol;
use App\Subcategoria;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Validator;

class ProductoController extends Controller
{
    public function Listar($id, Request $request)
    {
        $subcategorias = Producto::where('stock', ">", 0)->with('subcategoria', 'empresa')->where('idsubcategoria', $id)->whereHas('empresa', function ($q) use ($request) {
            $q->where('id', 'like', $request->get('empresita') . '%')->where('nombre', 'like', '%' . $request->get('buscarempresa') . '%');
        })->paginate(9);
        $resultados   = $subcategorias->count();
        $subcategorio = Subcategoria::where('id', $id)->first();
        $empresas     = Empresa::with('productos')->whereHas('productos', function ($q) use ($id) {
            $q->where('idsubcategoria', $id);
        })->get();

        $categorias = Categoria::with('subcategorias')->get();
        return view('Gestionar.Pedidos.productos', ['subcategorias' => $subcategorias, 'categorias' => $categorias, 'subcategorio' => $subcategorio, 'empresas' => $empresas, 'resultados' => $resultados]);
    }

    /*public function inicioEmpresa()
    {
    return view('Gestionar.productoEmpresa.inicio');
    }*/
    /*public function retornarCarrito()
    {
    $productos = \Session::get('productos');
    $total     = \Session::get('total');
    if (!empty($productos)) {
    $empresa = Empresa::findOrFail($productos[0]->idempresa)->nombre;
    return view('contenido.realizarCompra', ['productos' => $productos, 'total' => $total, 'empresa' => $empresa]);
    }
    return view('contenido.realizarCompra', ['productos' => $productos, 'total' => $total]);
    }*/

    /*public function listarDetalle($id)
    {
    $producto = Producto::with('empresa', 'subcategoria.categoria')->findOrFail($id);
    return response()->json(['producto' => $producto, 'promedio' => $producto->promedio]);
    }*/

    public function devolverDatos($id)
    {
        $dato = Producto::with('subcategoria', 'empresa')->findOrFail($id);
        return response()->json(['dato' => $dato]);
    }
    public function inicio()
    {
        $empresas      = Empresa::where('estado', 1)->get();
        $subcategorias = Subcategoria::where('estado', 1)->get();
        return view('Gestionar.Producto.inicio', ['empresas' => $empresas, 'subcategorias' => $subcategorias]);
    }
    public function guardar(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $rules = array(
                'nombre'       => 'required|max:50',
                'descripcion'  => 'required',
                'subcategoria' => 'required',
                'empresa'      => 'required',
                'stock'        => 'required',
                'precio'       => 'required',
            );

            $error = Validator::make($request->all(), $rules);

            if ($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }
            $producto                 = Producto::findOrFail($id);
            $producto->nombre         = $request->get('nombre');
            $producto->descripcion    = $request->get('descripcion');
            $producto->idsubcategoria = $request->get('subcategoria');
            $producto->idempresa      = $request->get('empresa');
            $producto->precio         = $request->get('precio');
            $producto->stock          = $request->get('stock');
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $file->move(storage_path() . '/app/public/productos/', $file->getClientOriginalName());
                $file             = $request->file('imagen');
                $imagen           = $file->getClientOriginalName();
                $producto->imagen = $imagen;
            }
            $producto->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return response()->json('correcto');
    }

    public function indexCarrito()
    {
        $productos = \Session::get('productos');
        dd($productos);
    }
    public function agregarCarrito(Request $request)
    {
        $id       = $request->input('id');
        $cantidad = $request->input('cantidad');
//nuevo primero = 1; producto a agregar =2; producto de otra empresa=3 ;stock insuficiente=4
        $producto  = Producto::findOrFail($id);
        $carrito   = \Session::get('productos');
        $idempresa = \Session::get('idempresa');

        if (!empty($carrito)) {
            if ($producto->idempresa == $idempresa) {
                $index = self::getIndexProductoCarrito($carrito, $producto->id);
                if ($index == -1) {
//el producto es nuevo
                    $arrayProducto = (object) array(
                        'id'        => $producto->id,
                        'nombre'    => $producto->nombre,
                        'precio'    => $producto->precio,
                        'imagen'    => $producto->imagen,
                        'cantidad'  => $cantidad,
                        'stock'     => $producto->stock,
                        'subtotal'  => $producto->precio * $cantidad,
                        'idempresa' => $producto->idempresa,
                    );
                    \Session::push('productos', $arrayProducto);
                    $this->calcularTotal();
                    return response()->json(['success' => true, 'message' => 'Producto agregado correctamente']);
                } else {

                    $productoCarrito           = $carrito[$index];
                    $productoCarrito->cantidad = $productoCarrito->cantidad + $cantidad;
                    $productoCarrito->subtotal = $productoCarrito->subtotal + ($productoCarrito->precio * $cantidad);
                    $carrito[$index]           = $productoCarrito;
                    \Session::put('productos', $carrito);
                    $this->calcularTotal();
                    return response()->json(['success' => true, 'message' => 'Producto agregado correctamente']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Producto de otra empresa']);
            }
        } else {
            $arrayProducto = (object) array(
                'id'        => $producto->id,
                'nombre'    => $producto->nombre,
                'precio'    => $producto->precio,
                'imagen'    => $producto->imagen,
                'cantidad'  => $cantidad,
                'stock'     => $producto->stock,
                'subtotal'  => $producto->precio * $cantidad,
                'idempresa' => $producto->idempresa,
            );
            \Session::push('productos', $arrayProducto);
            \Session::put('idempresa', $producto->idempresa);

            $this->calcularTotal();
            return response()->json(['success' => true, 'message' => 'Producto agregado correctamente']);
        }

    }

    public static function getIndexProductoCarrito($carrito, $idproducto)
    {
        foreach ($carrito as $i => $item) {
            if ($item->id == $idproducto) {
                return $i;
            }
        }
        return -1;
    }

    /*public function vaciarCarrito()
    {
    \Session::forget('productos');
    \Session::forget('total');
    \Session::forget('idempresa');

    return view('contenido.realizarCompra');

    }*/
    /*public function eliminarProducto($id)
    {
    $productos = \Session::get('productos');
    foreach ($productos as $clave => $item) {
    if ($id == $item->id) {
    unset($productos[$clave]);
    \Session::put('productos', $productos);
    $this->calcularTotal();
    $total = \Session::get('total');
    return redirect()->back();
    }
    }
    return redirect()->back();

    }*/
    public function calcularTotal()
    {
        $carrito = \Session::get('productos');
        $total   = 0;

        if (!empty($carrito)) {
            foreach ($carrito as $item) {
                $total = $total + $item->subtotal;
            }
            \Session::put('total', $total);
        } else {
            \Session::put('total', $total);
        }
    }

    /*public function stockProducto(Request $request)
    {
    $cantidad  = $request->get('cantidad');
    $id        = $request->get('id');
    $producto  = Producto::findOrFail($id);
    $productos = \Session::get('productos');
    foreach ($productos as $key => $item) {
    if ($producto->id == $item->id) {
    if ($cantidad <= $producto->stock) {
    $item->cantidad = $cantidad;
    $item->subtotal = $cantidad * $producto->precio;
    \Session::put('productos', $productos);
    $this->calcularTotal();
    return response()->json(['success' => true, 'message' => 'Producto actualizado']);
    } else {
    return response()->json(['success' => false, 'message' => 'Error stock insuficiente']);
    }
    }
    }
    return response()->json(['success' => false, 'message' => 'Error stock insuficiente']);
    }*/

    /*public function retornarFormulario()
    {
    $productos   = \Session::get('productos');
    $total       = \Session::get('total');
    $empresa     = Empresa::findOrFail($productos[0]->idempresa)->nombre;
    $calle       = \Session::get('calle');
    $referencia  = \Session::get('referencia');
    $nit         = \Session::get('nit');
    $latitud     = \Session::get('latitud');
    $longuitud   = \Session::get('longuitud');
    $detalle     = \Session::get('detalle');
    $razonsocial = \Session::get('razonsocial');
    if (empty($nit)) {
    $nit[0] = null;
    }if (empty($detalle)) {
    $detalle[0] = null;
    }
    if (empty($razonsocial)) {
    $razonsocial[0] = null;
    }if (empty($latitud)) {
    $latitud = null;
    }if (empty($longuitud)) {
    $longuitud = null;
    }if (empty($referencia)) {
    $referencia[0] = null;
    }if (empty($calle)) {
    $calle[0] = null;
    }
    return view('contenido.direccion', ['productos' => $productos, 'total' => $total, 'calle' => $calle, 'referencia' => $referencia, 'latitud' => $latitud, 'longuitud' => $longuitud, 'empresa' => $empresa, 'detalle' => $detalle[0], 'razonsocial' => $razonsocial[0], 'nit' => $nit[0]]);

    }*/
/*    public function guardarDireccion(Request $request)
{
$rules = array(
'calle'      => 'required',
'referencia' => 'required',
'longuitud'  => 'required',
'latitud'    => 'required',
);

$error = Validator::make($request->all(), $rules);

if ($error->fails()) {
return response()->json(['errors' => $error->errors()->all(), 'success' => false]);
}
$productos = \Session::get('productos');
$total     = \Session::get('total');
\Session::forget('calle');
\Session::forget('referencia');
\Session::forget('nit');
\Session::forget('longuitud');
\Session::forget('latitud');
\Session::forget('detalle');
\Session::forget('razonsocial');

\Session::push('calle', $request->get('calle'));
\Session::push('referencia', $request->get('referencia'));
\Session::push('nit', $request->get('nit'));
\Session::push('longuitud', $request->get('longuitud'));
\Session::push('latitud', $request->get('latitud'));
\Session::push('razonsocial', $request->get('razonsocial'));
\Session::push('detalle', $request->get('detalle'));

$calle   = \Session::get('calle');
$latitud = \Session::get('latitud');
return response()->json(['success' => true, 'message' => 'Error stock insuficiente', 'calle' => $calle, 'latitud' => $latitud]);
}
public function retornarMetodoPago()
{
$total     = \Session::get('total');
$productos = \Session::get('productos');
$empresa   = Empresa::findOrFail($productos[0]->idempresa)->nombre;
return view('contenido.metodoPago', ['total' => $total, 'empresa' => $empresa]);
}

public function finalizarPedido(Request $request)
{
$metodoPago = $request->get('metodoPagoEfectivo');
if ($metodoPago == 1) {
$productos   = \Session::get('productos');
$total       = \Session::get('total');
$calle       = \Session::get('calle');
$referencia  = \Session::get('referencia');
$nit         = \Session::get('nit');
$latitud     = \Session::get('latitud');
$longuitud   = \Session::get('longuitud');
$razonsocial = \Session::get('razonsocial');
$detalle     = \Session::get('detalle');
$idempresa   = \Session::get('idempresa');
if (!empty($productos) && !empty($total) && !empty($calle) && !empty($referencia) && !empty($latitud) &&
!empty($longuitud)) {
//dd($pedido);
$string       = " ";
$stockAgotado = false;
foreach ($productos as $key => $producto) {
$stockActual = Producto::findOrFail($producto->id);
$stockActual = $stockActual->stock;
if ($producto->cantidad > $stockActual) {
$string       = $string . " , " . $producto->nombre;
$stockAgotado = true;
}
}
if ($stockAgotado) {
\Session::flash('flash_message', 'Lo sentimos el stock se agotó ,para los productos :' . $string);
return Redirect::to('realizarPedido/carrito');
}

$fechahora                  = Carbon::now()->timezone('America/La_Paz')->toDateTimeString();
$pedido                     = new Pedido;
$pedido->idempresa          = $idempresa;
$pedido->idcliente          = Auth::guard('cliente')->user()->id;
$pedido->total              = $total;
$pedido->comision           = 0;
$pedido->latitud            = $latitud[0];
$pedido->longuitud          = $longuitud[0];
$pedido->nit                = $nit[0];
$pedido->detalle            = $detalle[0];
$pedido->calle              = $calle[0];
$pedido->razonsocial        = $razonsocial[0];
$pedido->referencia         = $referencia[0];
$pedido->referencia         = $referencia[0];
$pedido->estadopedidoactual = 1;
$pedido->fechahora          = $fechahora;
$pedido->save();

foreach ($productos as $key => $producto) {
$stockActual = Producto::findOrFail($producto->id);
$stockActual = $stockActual->stock;
if ($producto->cantidad <= $stockActual) {
$comision                  = Empresa::findOrFail($idempresa)->comision;
$detallePedido             = new DetallePedido;
$detallePedido->idpedido   = $pedido->id;
$detallePedido->idproducto = $producto->id;
$detallePedido->subtotal   = $producto->subtotal;
$detallePedido->cantidad   = $producto->cantidad;
$detallePedido->precio     = $producto->precio;

$detallePedido->comision = ((($comision) / 100) * $producto->precio) * $producto->cantidad;

$pedido->comision = $pedido->comision + $detallePedido->comision;
$detallePedido->save();
}

}
$pedido->save();
\Session::forget('calle');
\Session::forget('referencia');
\Session::forget('nit');
\Session::forget('longuitud');
\Session::forget('latitud');
\Session::forget('detalle');
\Session::forget('razonsocial');
\Session::forget('productos');
\Session::forget('total');
\Session::forget('idempresa');
}
return redirect()->to('/gestionarPedido/cliente');
} else {
$receiverId = 232543;
$secretKey  = '81627667d8dc53adcac6ceddcb7bed96ea080f5b';

$configuration = new \Khipu\Configuration();
$configuration->setReceiverId($receiverId);
$configuration->setSecret($secretKey);

$client   = new \Khipu\ApiClient($configuration);
$payments = new \Khipu\Client\PaymentsApi($client);

$imagen = Empresa::findOrFail(\Session::get('idempresa'))->imagen;
try {
$opts = array(
"transaction_id"     => "MTI-100",
"return_url"         => "http://127.0.0.1:8000/gestionarPedido/cliente",
"cancel_url"         => "http://127.0.0.1:8000/realizarPedido/MetodoPago",
"picture_url"        => 'http://127.0.0.1:8000/storage/productos/' . $imagen,
"notify_url"         => "http://mi-ecomerce.com/backend/notify",
"notify_api_version" => "1.3",
);
$response = $payments->paymentsPost(
"Pedido Nro 1", //Motivo de la compra
"BOB", //Monedas disponibles CLP, USD, ARS, BOB
\Session::get('total'), //Monto. Puede contener ","
$opts //campos opcionales
);
$response = json_decode($response);

return new RedirectResponse($response->payment_url);
} catch (\Khipu\ApiException $e) {
return response()->json(['dato' => $e->getResponseBody()]);
}
}
}*/

    public function listarP(Request $request)
    {
        $productos = null;

        if (auth()->user()->rol->id != Rol::$ADMINISTRADOR) {
            if (!empty(auth()->user()->usuarioempresa)) {
                $productos = Producto::where('idempresa', auth()->user()
                        ->usuarioempresa->empresa->id)->where('nombre', 'like', '%' . $request->get('nombre') . '%')->get();
            } else {
                $productos = Producto::where('idempresa', auth()->user()
                        ->repartidor->empresa->id)->where('nombre', 'like', '%' . $request->get('nombre') . '%')->get();
            }
        } elseif (auth()->user()->rol->id == Rol::$ADMINISTRADOR) {
            $productos = Producto::where('nombre', 'like', '%' . $request->get('nombre') . '%')->get();
        }

        return view('Gestionar.Productos.inicio', ['productos' => $productos]);
    }

    public function crear()
    {
        $subcategorias = Subcategoria::all();
        return view('Gestionar.Productos.registrar', ['subcategorias' => $subcategorias]);
    }

    public function registrar(ProductosRequest $request)
    {
        try {
            $producto                 = new Producto();
            $producto->nombre         = $request->get('nombre');
            $producto->descripcion    = $request->get('descripcion');
            $producto->stock          = $request->get('stock');
            $producto->precio         = $request->get('precio');
            $producto->idsubcategoria = $request->get('subcategoria');
            $producto->idempresa      = auth()->user()->usuarioempresa->empresa->id;
            if ($request->hasFile('imagen')) {
                $file   = $request->file('imagen');
                $nombre = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/storage/images/productos/', $nombre);
                $producto->imagen = $nombre;
            }
            $producto->save();
        } catch (\Exception $e) {
            return redirect()->route('productos.listar');
        }
        return redirect()->route('productos.listar');
    }

    public function ver($id)
    {
        $producto = Producto::findOrFail($id);
        return view('Gestionar.Productos.ver', ['producto' => $producto]);
    }

    public function editar($id)
    {
        $producto      = Producto::findOrFail($id);
        $subcategorias = Subcategoria::all();
        return view('Gestionar.Productos.editar', ['producto' => $producto, 'subcategorias' => $subcategorias]);
    }

    public function actualizar($id, ProductosRequest $request)
    {
        try {
            $producto                 = Producto::findOrFail($id);
            $producto->nombre         = $request->get('nombre');
            $producto->descripcion    = $request->get('descripcion');
            $producto->stock          = $request->get('stock');
            $producto->precio         = $request->get('precio');
            $producto->idsubcategoria = $request->get('subcategoria');
            $producto->idempresa      = auth()->user()->usuarioempresa->empresa->id;
            if ($request->hasFile('imagen')) {
                $file   = $request->file('imagen');
                $nombre = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/storage/images/productos/', $nombre);
                $producto->imagen = $nombre;
            }
            $producto->save();
        } catch (\Exception $e) {
            return redirect()->route('productos.listar');
        }
        return redirect()->route('productos.listar');
    }

    public function eliminar($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.listar');
    }

    public function aumentarStock($id)
    {
        $producto = Producto::findOrFail($id);
        return view('Gestionar.Productos.aumentarStock', ['producto' => $producto]);
    }

    public function actualizarStock($id, Request $request)
    {
        try {
            $this->validate($request, [
                'aumento' => 'required|numeric|min:1',
            ]);
            $producto        = Producto::findOrFail($id);
            $nuevoStock      = $producto->stock + $request->get('aumento');
            $producto->stock = $nuevoStock;
            $producto->save();
        } catch (\Exception $e) {
            return redirect()->route('productos.listar');
        }
        return redirect()->route('productos.listar');
    }
}
