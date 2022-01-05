<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Cliente;
use App\Empresa;
use App\Repartidor;
use App\Rol;
use App\User;
use App\Usuarioempresa;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Mail;

class UsuarioController extends Controller
{
    //gestionar clientes
    //gestionar usuarios a y pe
    //gestionar categoria
    //subcategoria
    //gestionar empresa
    //gestionar productos

    public function listar(Request $request)
    {
        $usuarios = User::with('usuarioempresa', 'repartidor')->where('idrol', "!=", 4)->where('idrol', "!=", 1)->where('name', 'like', $request->get('nombre') . '%')->paginate(6);
        return view('Gestionar.Usuario.inicio', ['usuarios' => $usuarios]);
    }
    public function formularioRegistro()
    {
        $empresas = Empresa::get();
        $roles    = Rol::where('id', "!=", 4)->where('id', "!=", 1)->get();
        return view('Gestionar.Usuario.registrar', ['empresas' => $empresas, 'roles' => $roles]);
    }
    public function registrar(Request $request)
    {
        DB::beginTransaction();
        try {
            $messages = [
                'ccontraseña.required'            => 'El campo confirmar contraseña es obligatorio',
                'ccontraseña.same'                => 'El campo confirmar contraseña es tiene que ser igual a la contraseña',
                'fechanacimiento.required'        => 'El campo fecha de nacimiento es obligatorio',
                'fechanacimiento.before_or_equal' => 'Usted es menor de edad',
            ];
            $this->validate($request, [
                'name'            => 'required',
                'apellidos'       => 'required',
                'email'           => 'required|email|unique:users',
                'contraseña'      => 'required',
                'ccontraseña'     => 'required|same:contraseña',
                'idrol'           => 'required',
                'empresa'         => 'required',
                'telefono'        => 'required|max:8|min:8',
                'ci'              => 'required',
                'sexo'            => 'required',
                'fechanacimiento' => "required|date|before_or_equal:" . Carbon::now()->subYears(18)->format("Y-m-d"),
                'imagen'          => 'required',
                'rol'             => 'required',
            ], $messages);
            $usuario                  = new User;
            $usuario->name            = $request->get('name');
            $usuario->email           = $request->get('email');
            $usuario->apellidos       = $request->get('apellidos');
            $usuario->password        = bcrypt($request->get('contraseña'));
            $usuario->idrol           = $request->get('rol');
            $usuario->telefono        = $request->get('telefono');
            $usuario->ci              = $request->get('ci');
            $usuario->fechanacimiento = $request->get('fechanacimiento');
            $usuario->sexo            = $request->get('sexo');
            $usuario->estado          = 1;
            $rolito                   = $request->get('idrol');
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $file->move(storage_path() . '/app/public/images/usuarios/', $file->getClientOriginalName());
                $file            = $request->file('imagen');
                $imagen          = $file->getClientOriginalName();
                $usuario->imagen = $imagen;
            }
            $usuario->save();
            if ($rolito == 2) {
                $usuarioEmpresa            = new Usuarioempresa;
                $usuarioEmpresa->idusuario = $usuario->id;
                $usuarioEmpresa->idempresa = $request->get('empresa');
                $usuarioEmpresa->save();
            } else if ($rolito == 3) {
                $repartidor                    = new Repartidor;
                $repartidor->idusuario         = $usuario->id;
                $repartidor->idempresa         = $request->get('empresa');
                $repartidor->cantidadDePedidos = 0;
                $repartidor->save();
            }

            $detalleBitacora = 'registro al usuario con ID:' . $usuario->id . ' con nombre: ' . $usuario->name . ' y apellidos: ' . $usuario->apellidos;
            Bitacora::registrarBitacora(3, $detalleBitacora);
            \Session::flash('flash_message', 'El usuario se registró correctamente');
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return Redirect::to('/usuario/listar');
    }

    public function devolverDatos($id)
    {
        $usuario  = User::with('repartidor', 'usuarioempresa')->findOrFail($id);
        $rol      = Rol::findOrFail($usuario->idrol);
        $empresas = Empresa::get();
        return view('Gestionar.Usuario.editar', ['usuario' => $usuario, 'empresas' => $empresas, 'rol' => $rol]);
    }
    public function inicio()
    {
        return view('Gestionar.Usuario.inicio');
    }
    public function editar(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $messages = [
                'fechanacimiento.required'        => 'El campo fecha de nacimiento es obligatorio',
                'fechanacimiento.before_or_equal' => 'Usted es menor de edad',
            ];
            $this->validate($request, [
                'name'            => 'required',
                'apellidos'       => 'required',
                'telefono'        => 'required|max:8|min:8',
                'ci'              => 'required',
                'sexo'            => 'required',
                'fechanacimiento' => "required|date|before_or_equal:" . Carbon::now()->subYears(18)->format("Y-m-d"),
            ], $messages);
            $usuario            = User::findOrFail($id);
            $usuario->name      = $request->get('name');
            $usuario->apellidos = $request->get('apellidos');
            if (!empty($request->get('contraseña'))) {
                $usuario->password = bcrypt($request->get('contraseña'));
            }
            $usuario->telefono        = $request->get('telefono');
            $usuario->ci              = $request->get('ci');
            $usuario->fechanacimiento = $request->get('fechanacimiento');
            $usuario->sexo            = $request->get('sexo');
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $file->move(storage_path() . '/app/public/images/usuarios/', $file->getClientOriginalName());
                $file            = $request->file('imagen');
                $imagen          = $file->getClientOriginalName();
                $usuario->imagen = $imagen;
            }
            $usuario->save();
            $detalleBitacora = 'editó al usuario con ID:' . $usuario->id . ' con nombre: ' . $usuario->name . ' y apellidos: ' . $usuario->apellidos;
            Bitacora::registrarBitacora(2, $detalleBitacora);
            \Session::flash('flash_message', 'El usuario se editó correctamente');
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return Redirect::to('/usuario/listar');
    }

    public function cambiarEstado($id, $estado)
    {
        //activado = 1 ;desactivado =1 ;eliminado=2;
        $usuario         = User::findOrFail($id);
        $usuario->estado = $estado;
        $usuario->save();
        $detalleBitacora = 'actulizó el estado al usuario con ID:' . $usuario->id . ' con nombre: ' . $usuario->name . ' y apellidos: ' . $usuario->apellidos;
        \Session::flash('flash_message', 'El estado se actulizó correctamente');
        Bitacora::registrarBitacora(3, $detalleBitacora);
        return Redirect::to('/usuario/listar');
    }
    public function ver($id)
    {
        //activado = 1 ;desactivado =1 ;eliminado=2;
        $usuario  = User::with('repartidor', 'usuarioempresa')->findOrFail($id);
        $rol      = Rol::findOrFail($usuario->idrol);
        $empresas = Empresa::get();
        return view('Gestionar.Usuario.ver', ['usuario' => $usuario, 'empresas' => $empresas, 'rol' => $rol]);
    }

    public function eliminar($id)
    {

        $usuario         = User::find($id);
        $detalleBitacora = 'eliminó al usuario con ID:' . $usuario->id . ' con nombre: ' . $usuario->name . ' y apellidos: ' . $usuario->apellidos;
        Bitacora::registrarBitacora(4, $detalleBitacora);
        $usuario->delete();
        \Session::flash('flash_message', 'El usuario se eliminó correctamente');
        return Redirect::to('/usuario/listar');
    }

    public function correo()
    {
        $cliente        = Cliente::find(1);
        $cliente->token = bin2hex(random_bytes(30));
        $cliente->update();

        $subject = "Verificacion de correo electronico";
        $for     = $cliente->email;
        $data    = array('nombreCliente' => $cliente->nombre, 'token' => $cliente->token);

        Mail::send('Email.verificacion', $data, function ($msj) use ($subject, $for) {
            $msj->from("homemarket.info1@gmail.com", "Home Market");
            $msj->subject($subject);
            $msj->to($for);
        });

    }

    public function verificacion($token)
    {
        $cliente             = Cliente::where('token', $token)->first();
        $cliente             = Cliente::find($cliente->id);
        $cliente->token      = '';
        $cliente->verificado = 1;
        $cliente->update();
        return Redirect::to('/');

    }

}
