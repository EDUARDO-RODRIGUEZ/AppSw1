<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Categoria;
use App\Rol;
use App\RolAccion;
use App\RolPrivilegio;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RolController extends Controller
{

    public function listar(Request $request)
    {
        //desactivar = 0;
        //activar = 1;
        //eliminar = 2;
        $roles = Rol::with('rolprivilegioes', 'rolacciones')->where('id', '!=', 1)->where('id', '!=', 4)->where('nombre', 'like', $request->get('nombre') . '%')->paginate(6);
        return view('Gestionar.Rol.inicio', ['roles' => $roles]);
    }
    public function formularioRegistro()
    {

        return view('Gestionar.Rol.registrar');
    }
    public function registrar(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'nombre'      => 'required',
                'descripcion' => 'required',
            ]);
            $rol              = new Rol;
            $rol->nombre      = $request->get('nombre');
            $rol->descripcion = $request->get('descripcion');
            $rol->save();
            $idrol = $rol->id;

            //foreach para acciones
            if (empty($request->get('producto')) && empty($request->get('pedido'))) {
                \Session::flash('flash_message', 'No puede registrar un rol sin acciones');
                return Redirect::to('/rol/formulario');
            }
            if (!empty($request->get('producto'))) {
                $accion            = new RolAccion;
                $accion->idrol     = $idrol;
                $accion->idaccion  = 1;
                $accion->eliminado = 0;
                $accion->save();

            }
            if (!empty($request->get('pedido'))) {
                $accionn            = new RolAccion;
                $accionn->idrol     = $idrol;
                $accionn->idaccion  = 2;
                $accionn->eliminado = 0;
                $accionn->save();
            }
            $p               = new RolPrivilegio;
            $p->idrol        = $idrol;
            $p->idprivilegio = 1;
            $p->eliminado    = 0;
            $p->save();
            $privilegios = $request->get('privilegio');
            if (!empty($privilegios)) {
                foreach ($privilegios as $idprivilegio) {
                    $rolprivilegio               = new RolPrivilegio;
                    $rolprivilegio->idrol        = $idrol;
                    $rolprivilegio->idprivilegio = $idprivilegio;
                    $rolprivilegio->eliminado    = 0;
                    $rolprivilegio->save();
                }}
            $detalleBitacora = 'registro el rol con ID:' . $rol->id . ' con nombre: ' . $rol->nombre;
            Bitacora::registrar(3, $detalleBitacora);
            \Session::flash('flash_message', 'El rol se registró correctamente');
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return Redirect::to('/rol/listar');
    }

    public function devolverDatos($id)
    {
        $rol = Rol::with('rolprivilegioes', 'rolacciones')->findOrFail($id);
        return view('Gestionar.Rol.editar', ['rol' => $rol]);
    }

    public function editar(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'nombre'      => 'required',
                'descripcion' => 'required',
            ]);
            if (empty($request->get('producto')) && empty($request->get('pedido'))) {
                \Session::flash('flash_message', 'No puede registrar un rol sin acciones');
                return Redirect::to('/rol/devolverDatos/' . $id);
            }
            $creado           = -1;
            $rol              = Rol::findOrFail($id);
            $rol->nombre      = $request->get('nombre');
            $rol->descripcion = $request->get('descripcion');
            $rol->save();
            $idrol = $rol->id;
            //foreach para eliminar privilesgios
            for ($i = 1; $i <= count($rol->rolprivilegioes); $i++) {
                if ($rol->rolprivilegioes[$i - 1]->idprivilegio != 1) {
                    $rol->rolprivilegioes[$i - 1]->eliminado = 1;
                    $rol->rolprivilegioes[$i - 1]->save();
                }

            }
            for ($i = 1; $i <= count($rol->rolacciones); $i++) {
                $rol->rolacciones[$i - 1]->eliminado = 1;
                $rol->rolacciones[$i - 1]->save();
            }

            //foreach para acciones
            if (!empty($rol->rolacciones[0])) {
                if ($rol->rolacciones[0]->idaccion == 1 && !empty($request->get('producto'))) {
                    $creado                         = 1;
                    $rol->rolacciones[0]->eliminado = 0;
                    $rol->rolacciones[0]->save();
                } else if ($rol->rolacciones[0]->idaccion == 2 && !empty($request->get('pedido'))) {
                    $creado                         = 2;
                    $rol->rolacciones[0]->eliminado = 0;
                    $rol->rolacciones[0]->save();
                }

            } else {
                if (!empty($request->get('producto'))) {
                    $creado       = 1;
                    $g            = new RolAccion;
                    $g->idrol     = $idrol;
                    $g->idaccion  = 1;
                    $g->eliminado = 0;
                    $g->save();
                } else if (!empty($request->get('pedido'))) {
                    $creado       = 2;
                    $p            = new RolAccion;
                    $p->idrol     = $idrol;
                    $p->idaccion  = 2;
                    $p->eliminado = 0;
                    $p->save();
                }
            }

            if (!empty($rol->rolacciones[1])) {
                if ($rol->rolacciones[1]->idaccion == 1 && !empty($request->get('producto'))) {
                    $rol->rolacciones[1]->eliminado = 0;
                    $rol->rolacciones[1]->save();
                } else if ($rol->rolacciones[1]->idaccion == 2 && !empty($request->get('pedido'))) {
                    $rol->rolacciones[1]->eliminado = 0;
                    $rol->rolacciones[1]->save();
                }

            } else {
                if ($creado == -1) {
                    if (!empty($request->get('producto'))) {
                        $g            = new RolAccion;
                        $g->idrol     = $idrol;
                        $g->idaccion  = 1;
                        $g->eliminado = 0;
                        $g->save();
                    } else if (!empty($request->get('pedido'))) {
                        $p            = new RolAccion;
                        $p->idrol     = $idrol;
                        $p->idaccion  = 2;
                        $p->eliminado = 0;
                        $p->save();
                    }
                }
                if (!empty($request->get('producto')) && $creado == 2) {
                    $g            = new RolAccion;
                    $g->idrol     = $idrol;
                    $g->idaccion  = 1;
                    $g->eliminado = 0;
                    $g->save();
                } else if (!empty($request->get('pedido')) && $creado == 1) {
                    $p            = new RolAccion;
                    $p->idrol     = $idrol;
                    $p->idaccion  = 2;
                    $p->eliminado = 0;
                    $p->save();
                }
            }

/*            for ($i = 1; $i <= 2; $i++) {
if (!empty($rol->rolacciones[$i - 1])) {
if ($rol->rolacciones[$i - 1]->idaccion == 1 && !empty($request->get('producto'))) {
$rol->rolacciones[$i - 1]->eliminado = 0;
$rol->rolacciones[$i - 1]->save();
} else if ($rol->rolacciones[$i - 1]->idaccion == 2 && !empty($request->get('pedido'))) {
$rol->rolacciones[$i - 1]->eliminado = 0;
$rol->rolacciones[$i - 1]->save();
}

} else {
if (!empty($request->get('producto'))) {
$g            = new RolAccion;
$g->idrol     = $idrol;
$g->idaccion  = 1;
$g->eliminado = 0;
$g->save();
} else if (!empty($request->get('pedido'))) {
$p            = new RolAccion;
$p->idrol     = $idrol;
$p->idaccion  = 2;
$p->eliminado = 0;
$p->save();
}
}

}*/
            $privil      = -1;
            $contador    = 0;
            $limite      = count($rol->rolprivilegioes);
            $privilegios = $request->get('privilegio');
            if (!empty($privilegios)) {
                foreach ($privilegios as $privilegio) {
                    for ($i = 1; $i <= count($rol->rolprivilegioes) && $privil == -1; $i++) {
                        if ($privilegio == $rol->rolprivilegioes[$i - 1]->idprivilegio) {
                            $rol->rolprivilegioes[$i - 1]->eliminado = 0;
                            $rol->rolprivilegioes[$i - 1]->save();
                            $privil = 1;
                        }
                    }

                    if ($privil == -1) {
                        //nuevo
                        $a               = new RolPrivilegio;
                        $a->idrol        = $idrol;
                        $a->idprivilegio = $privilegio;
                        $a->eliminado    = 0;
                        $a->save();
                    }
                    $privil = -1;
                }
            }
            $rol->save();

            $detalleBitacora = 'editó el rol con ID:' . $rol->id . ' con nombre: ' . $rol->nombre;
            Bitacora::registrar(2, $detalleBitacora);
            \Session::flash('flash_message', 'El rol se editó correctamente');
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return Redirect::to('/rol/listar');
    }

    public function ver($id)
    {
        //activado = 1 ;desactivado =1 ;eliminado=2;
        $categoria = Categoria::findOrFail($id);
        return view('Gestionar.Categoria.ver', ['categoria' => $categoria]);
    }

    public function eliminar($id)
    {
        $rol             = Rol::find($id);
        $detalleBitacora = 'eliminó el rol con ID:' . $rol->id . ' con nombre: ' . $rol->nombre;
        Bitacora::eliminar(4, $detalleBitacora);
        $rol->delete();
        \Session::flash('flash_message', 'El rol se eliminó correctamente');
        return Redirect::to('/rol/listar');
    }
    public function listarCliente()
    {
        $Categorias = Categoria::where('estado', '!=', '2')->get();
        return view('Contenido.categorias', ['Categorias' => $Categorias]);
    }
}
