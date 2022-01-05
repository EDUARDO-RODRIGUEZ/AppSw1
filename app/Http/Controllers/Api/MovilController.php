<?php

namespace App\Http\Controllers\Api;

use App\DetallePedido;
use App\Empresa;
use App\Http\Controllers\Controller;
use App\Pedido;
use App\Producto;
use App\User;
use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MovilController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $cliente = Cliente::where('email', $request->email)->first();

        if ($cliente != null) {
            return response()->json(['success' => true, 'message' => 'Login correcto', 'data' => $cliente]);
        } else {
            return response()->json(['success' => false, 'message' => 'Correo o contraseña incorrectas', 'data' => null]);
        }


        /*
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user_auth          = Auth::cliente();
            $usuario            = User::select('id', 'name', 'email', 'apellidos', 'imagen')->find($user_auth->id);
            $empresa            = Empresa::where('id', $user_auth->usuarioempresa->empresa->id)->first();
            $usuario->empresa   = $empresa->nombre;
            $usuario->idempresa = $empresa->id;
            return response()->json(['success' => true, 'message' => 'Login correcto', 'data' => $usuario]);
        } else {
            return response()->json(['success' => false, 'message' => 'Correo o contraseña incorrectas', 'data' => null]);
        }
        */
    }
    public function listarPedidos(Request $request)
    {
        $pedidos = Pedido::where('idrepartidor', $request->id)->get();
        return response()->json(['success' => true, 'message' => 'Login correcto', 'data' => $pedidos]);
    }
    public function cambiarEstado(Request $request)
    {
        $pedido                     = Pedido::findOrFail($request->get('id'));
        $pedido->estadopedidoactual = $request->get("estado");
        $pedido->save();
        return response()->json(['success' => true, 'message' => 'Login correcto', 'data' => null]);
    }
    public function detallePedido(Request $request)
    {
        $detalles = DetallePedido::with('producto')->where('idpedido', $request->get('id'))->get();
        return response()->json(['success' => true, 'message' => 'Login correcto', 'data' => $detalles]);
    }
    public function info(Request $request)
    {
        $detalles = Pedido::with('cliente')->where('id', $request->get('id'))->get();
        return response()->json(['success' => true, 'message' => 'Login correcto', 'data' => $detalles]);
    }
    public function listarProductos(Request $request)
    {
        // $productos = Producto::where('idempresa', $request->idempresa, 'idsubcategoria' => $request->categoria)->get();

        // Adicionado if ed
        if ($request->has('idempresa') && $request->has('categoria')) {

            $productos = DB::select(
                "SELECT
                p.id,
                p.nombre,
                p.stock,
                p.precio,
                CONCAT( '/imagenes/productos/', p.imagen ) AS imagen,
                p.descripcion,
                p.idsubcategoria,
                p.idempresa
            FROM
                producto p
            WHERE
                p.idempresa = $request->idempresa and p.idsubcategoria=$request->categoria"
            );
        } else {

            $productos = DB::select(
                "SELECT
                p.id,
                p.nombre,
                p.stock,
                p.precio,
                CONCAT( '/imagenes/productos/', p.imagen ) AS imagen,
                p.descripcion,
                p.idsubcategoria,
                p.idempresa
            FROM
                producto p"
            );
        }

        return response()->json(['success' => true, 'message' => 'Login correcto', 'data' => $productos]);
    }
    public function registrarProducto(Request $request)
    {
        $producto                 = new Producto;
        $producto->nombre         = $request->nombre;
        $producto->precio         = $request->precio;
        $producto->idsubcategoria = $request->idsubcategoria;
        $producto->idempresa      = $request->idempresa;
        $producto->stock          = $request->stock;
        $producto->descripcion    = $request->descripcion;
        $producto->imagen         = $request->imagen;
        $producto->save();
        return response()->json(['success' => true, 'message' => 'Login correcto', 'data' => $producto]);
    }
    public function registrar_pedido(Request $request)
    {

        $id_cliente = $request->id_cliente;
        //verificar si existe usuario
        $existecliente = DB::select(
            "SELECT
                c.id
            FROM
                cliente c
            WHERE
                c.id =$id_cliente"
        );
        if (count($existecliente) == 0) {
            return response()->json(['success' => false, 'message' => 'el cliente no existe', 'data' => null]);
        }
        //si ya tiene un pedido
        $pedido1 = DB::select(
            "SELECT
                p.id
            FROM
                pedido p
            WHERE
                p.idcliente =$id_cliente and p.estadopedidoactual =1 "
        );
        if (count($pedido1) > 0) {
            return response()->json(['success' => false, 'message' => 'Ya tiene un pedido pendiente', 'data' => null]);
        }
        $productos = json_decode(json_encode($request->input('productos')));
        //verificar q los productos sean de la mismas empresa
        for ($i = 0; $i < count($productos); $i++) {
            $id_producto1 = $productos[0]->id_producto;
            $id_producto = $productos[$i]->id_producto;
            $detalledelproducto = DB::select(
                "SELECT
                p.id,
                p.nombre,
                p.stock,
                p.precio,
                CONCAT( '/imagenes/productos/', p.imagen ) AS imagen,
                p.descripcion,
                p.idsubcategoria,
                p.idempresa
            FROM
                producto p
            WHERE
                p.id =$id_producto"
            );
            $idempresa1 = $detalledelproducto[0]->idempresa;
            /*
        if(count($detalledelproducto)>0){
            if($i>0){
                $detalledelproducto1 = DB::select(
                    "SELECT
                        p.id,
                        p.nombre,
                        p.stock,
                        p.precio,
                        CONCAT( '/imagenes/productos/', p.imagen ) AS imagen,
                        p.descripcion,
                        p.idsubcategoria,
                        p.idempresa
                    FROM
                        producto p
                    WHERE
                        p.id =$id_producto1"
                );
                $idempresa1 =$detalledelproducto1[0]->idempresa;
                $idempresa2 = $detalledelproducto[0]->idempresa;
                if($idempresa1!=$idempresa2){
                    return response()->json(['success' => false, 'message' => 'Los productos deben ser de las misma empresa', 'data' => null]);
                }
            }

        }else{
            return response()->json(['success' => false, 'message' => 'el producto '. $id_producto.' no existe', 'data' => null]);
        }
        */
        }

        //crear el pedido en blanco
        DB::table('pedido')->insert([
            'idcliente' => $id_cliente,
            'idempresa' => $idempresa1,
            'estadopedidoactual' => 1
        ]);

        //crear detalle pedido
        $pedido = DB::select(
            "SELECT
                p.id
            FROM
                pedido p
            WHERE
                p.idcliente =$id_cliente and p.estadopedidoactual =1 "
        );
        $total = 0;
        for ($i = 0; $i < count($productos); $i++) {
            $id_producto = $productos[$i]->id_producto;
            $cantidad = $productos[$i]->cantidad;
            $id_pedido = $pedido[0]->id;
            $detalledelproducto = DB::select(
                "SELECT
                    p.id,
                    p.nombre,
                    p.stock,
                    p.precio,
                    CONCAT( '/imagenes/productos/', p.imagen ) AS imagen,
                    p.descripcion,
                    p.idsubcategoria,
                    p.idempresa
                FROM
                    producto p
                WHERE
                    p.id =$id_producto"
            );
            $precio = $detalledelproducto[0]->precio;
            $total = $total + $precio;
            DB::table('detallepedido')->insert([
                'idpedido' => $id_pedido,
                'idproducto' => $id_producto,
                'cantidad' => $cantidad,
                'precio' =>  $precio,
                'subtotal' =>  $precio * $cantidad
            ]);
        }

        DB::table('pedido')->where('id', $id_pedido)
            ->update([
                'total' => $total
            ]);

        return response()->json(['success' => true, 'message' => 'Pedido realizado Con exito', 'data' => $productos]);
    }

    public function listar_pedidos(Request $request)
    {

        $Pedido = DB::select(
            "SELECT
                p.id as idpedido,
                p.total
            FROM
                pedido p
            WHERE
                p.idcliente = $request->id_cliente and p.estadopedidoactual=1"
        );
        if (count($Pedido) > 0) {
            foreach ($Pedido as $value) {
                $value->{'productos'} = DB::select(
                    "SELECT
                        dp.idproducto,
                        pro.nombre,
                        pro.precio
                    FROM
                        pedido p,detallepedido dp,producto pro
                    WHERE
                       p.id=dp.idpedido
                       and dp.idproducto=pro.id
                       and p.idcliente = $request->id_cliente
                       and p.estadopedidoactual=1"
                );
            }
        } else {
            return response()->json(['success' => false, 'message' => 'no se tiene pedidos', 'data' => null]);
        }

        return response()->json(['success' => true, 'message' => 'Login correcto', 'data' => $Pedido]);
    }

    public function listar_comentarios_producto(Request $request)
    {
        $idproducto = $request->id_producto;

        $Pedido = DB::select(
            "SELECT
                dp.idproducto,
                pro.nombre,
                dp.promedio,
                dp.calificacion,
                dp.comentario
            FROM
                detallepedido dp,producto pro
            WHERE
                dp.idproducto=pro.id and
                dp.idproducto = $idproducto and
                dp.calificado = 1
                "
        );

        $pointsProduct = DetallePedido::where('calificado', 1)
            ->where('idproducto', $idproducto)
            ->avg('promedio');

        if (is_null($pointsProduct)) {
            $pointsProduct = 0;
        }

        if (count($Pedido) > 0) {
            return response()->json([
                'success' => true,
                'message' => 'CORRECTO',
                'points' => $pointsProduct,
                'data' => $Pedido
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'no se tiene comentarios del producto',
                'points' => $pointsProduct,
                'data' => null
            ]);
        }
    }

    public function listar_productos_sin_calificar(Request $request)
    {
        $id_cliente = $request->id_cliente;

        $Pedido = DB::select(
            "SELECT
                dp.id as Iddetalle,
                p.id as idPedido ,
                dp.idproducto,
                pro.nombre,
                pro.precio,
                CONCAT( '/imagenes/productos/', pro.imagen ) AS imagen,
                pro.descripcion,
                pro.idsubcategoria,
                dp.comentario,
                dp.calificacion,
                dp.promedio
            FROM
                pedido p,detallepedido dp,producto pro
            WHERE
                p.id=dp.idpedido and
                dp.idproducto=pro.id and
                p.idcliente= $id_cliente and
                dp.calificado = 0
            ORDER BY
                 p.id ASC
                "
        );
        if (count($Pedido) > 0) {
            return response()->json(['success' => true, 'message' => 'CORRECTO', 'data' => $Pedido]);
        } else {
            return response()->json(['success' => false, 'message' => 'no se tiene una lista de productos a calificar', 'data' => null]);
        }
    }

    public function agregar_comentario_producto(Request $request)
    {
        $Iddetalle = $request->Iddetalle;
        $idPedido = $request->idPedido;
        $idproducto = $request->idproducto;
        $calificacion = $request->calificacion;
        $comentario = $request->comentario;
        $promedio = $request->promedio;

        $update = [
            'calificado' => 1,
            'promedio' => $promedio,
            'calificacion' => $calificacion,
            'comentario' => $comentario
        ];

        $detallepedido = DetallePedido::where('id', $Iddetalle)
            ->where('idpedido', $idPedido)
            ->where('idproducto', $idproducto)
            ->update($update);

        if (!$detallepedido) {
            return response()->json([
                'success' => false,
                'message' => 'El producto no pudo calificarse!!!'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'El producto se califico correctamente',
        ]);
    }
}
