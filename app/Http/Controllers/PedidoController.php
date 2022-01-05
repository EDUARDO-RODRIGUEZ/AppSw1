<?php

namespace App\Http\Controllers;

use App\DetallePedido;
use App\Empresa;
use App\Pedido;
use App\Producto;
use App\Repartidor;
use App\Rol;
use App\User;
use App\Usuarioempresa;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;

class PedidoController extends Controller
{
    public static function getIndexProductoCarrito($carrito, $idproducto)
    {
        foreach ($carrito as $i => $item) {
            if ($item->id == $idproducto) {
                return $i;
            }
        }
        return -1;
    }
    public function retornarCarrito()
    {
        $productos = \Session::get('productos');
        $total     = \Session::get('total');
        if (!empty($productos)) {
            $empresa = Empresa::findOrFail($productos[0]->idempresa)->nombre;
            return view('Gestionar.Pedidos.realizarCompra', ['productos' => $productos, 'total' => $total, 'empresa' => $empresa]);
        }
        return view('Gestionar.Pedidos.realizarCompra', ['productos' => $productos, 'total' => $total]);
    }
    public function guardarDireccion(Request $request)
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
        return view('Gestionar.Pedidos.metodoPago', ['total' => $total, 'empresa' => $empresa]);
    }

    public function finalizarPedido(Request $request)
    {

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

    }
    public function retornarFormulario()
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
        return view('Gestionar.Pedidos.direccion', ['productos' => $productos, 'total' => $total, 'calle' => $calle, 'referencia' => $referencia, 'latitud' => $latitud, 'longuitud' => $longuitud, 'empresa' => $empresa, 'detalle' => $detalle[0], 'razonsocial' => $razonsocial[0], 'nit' => $nit[0]]);

    }
    public function stockProducto(Request $request)
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
    }
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
    public function eliminarProducto($id)
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

    }
    public function vaciarCarrito()
    {
        \Session::forget('productos');
        \Session::forget('total');
        \Session::forget('idempresa');

        return view('Gestionar.Pedidos.realizarCompra');

    }
    public function indicePedido()
    {
        $pedidos = Pedido::with('detallePedidos')->where('idcliente', Auth::guard('cliente')->user()->id)->get();

        return view('Gestionar.Pedido.clientePedido', ['pedidos' => $pedidos]);
    }

    public function listar()
    {

        $pedidos = null;
        if (!empty(auth()->user()->usuarioempresa) && auth()->user()->rol->id != Rol::$ADMINISTRADOR) {
            $personal = auth()->user()->usuarioempresa;
            $pedidos  = $personal->empresa->pedidos;
        } elseif (!empty(auth()->user()->repartidor) && auth()->user()->rol->id != Rol::$ADMINISTRADOR) {
            $pedidos = Pedido::with('repartidor')->where('idrepartidor', '=', auth()->user()
                    ->repartidor->id)->orderBy('estadopedidoactual')->get();
        } else {
            $pedidos = Pedido::all()->sortBy('idempresa');
        }
        return view('Gestionar.Pedidos.inicio', ['pedidos' => $pedidos]);
    }

    public function cambiarEstado($id, $estado)
    {
        DB::beginTransaction();
        try {
            $pedido                     = Pedido::findOrFail($id);
            $pedido->estadopedidoactual = $estado;
            if ($estado == 5) {
                $empresa                = Empresa::findOrFail($pedido->idempresa);
                $comisionNueva          = $empresa->totalcomision;
                $empresa->totalcomision = $comisionNueva + $pedido->comision;
                $empresa->save();
                $detallePedido = DetallePedido::where('idpedido', $id)->get();
                foreach ($detallePedido as $detalle) {
                    # code...
                    $producto        = Producto::findOrFail($detalle->idproducto);
                    $stock           = $detalle->cantidad + $producto->stock;
                    $producto->stock = $stock;
                    $producto->save();
                }
            }

            if ($pedido->idrepartidor != null && ($estado == Pedido::$FINALIZADO || $estado ==
                Pedido::$CANCELADO)) {
                $repartidor = Repartidor::findOrFail($pedido->idrepartidor);
                if ($repartidor->cantidadDePedidos > 0) {
                    $disminuir                     = $repartidor->cantidadDePedidos - 1;
                    $repartidor->cantidadDePedidos = $disminuir;
                    $repartidor->save();
                }
            }
            $pedido->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('pedidos.listar');
    }

    public function asignarRepartidor($id)
    {
        $pedido       = Pedido::findOrFail($id);
        $repartidores = $pedido->empresa->repartidores;
        return view('Gestionar.Pedidos.asignarRepartidor', ['pedido' => $pedido,
            'repartidores'                                               => $repartidores]);
    }

    public function guardarRepartidor($id, $idrepartidor)
    {
        DB::beginTransaction();
        try {
            $pedido                        = Pedido::findOrFail($id);
            $pedido->idrepartidor          = $idrepartidor;
            $pedido->estadopedidoactual    = Pedido::$CAMINO;
            $repartidor                    = Repartidor::findOrFail($idrepartidor);
            $aumento                       = $repartidor->cantidadDePedidos + 1;
            $repartidor->cantidadDePedidos = $aumento;
            $pedido->save();
            $repartidor->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('pedidos.listar');
    }

}
