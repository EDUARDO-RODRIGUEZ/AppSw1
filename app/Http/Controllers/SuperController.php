<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Empresa;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SuperController extends Controller
{
    public function listar(Request $request)
    {
        $usuarios = User::where('idrol', '=', 1)->paginate(6);
        return view('Gestionar.SuperAdministrador.inicio', ['usuarios' => $usuarios]);
    }
    public function formularioRegistro()
    {
        return view('Gestionar.SuperAdministrador.registrar');
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
                'telefono'        => 'required|max:8|min:8',
                'ci'              => 'required',
                'sexo'            => 'required',
                'fechanacimiento' => "required|date|before_or_equal:" . Carbon::now()->subYears(18)->format("Y-m-d"),
                'imagen'          => 'required',
            ], $messages);
            $usuario                  = new User;
            $usuario->name            = $request->get('name');
            $usuario->email           = $request->get('email');
            $usuario->apellidos       = $request->get('apellidos');
            $usuario->password        = bcrypt($request->get('contraseña'));
            $usuario->idrol           = 1;
            $usuario->telefono        = $request->get('telefono');
            $usuario->ci              = $request->get('ci');
            $usuario->fechanacimiento = $request->get('fechanacimiento');
            $usuario->sexo            = $request->get('sexo');
            $usuario->estado          = 1;
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $file->move(storage_path() . '/app/public/productos/', $file->getClientOriginalName());
                $file            = $request->file('imagen');
                $imagen          = $file->getClientOriginalName();
                $usuario->imagen = $imagen;
            }
            $usuario->save();
            $detalleBitacora = 'registró al administrador con ID:' . $usuario->id . ' con nombre: ' . $usuario->name . ' y apellidos: ' . $usuario->apellidos;
            Bitacora::registrarBitacora(3, $detalleBitacora);
            \Session::flash('flash_message', 'El administrador se registró correctamente');
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return Redirect::to('/super/listar');
    }

    public function devolverDatos($id)
    {
        $usuario  = User::findOrFail($id);
        $empresas = Empresa::get();
        return view('Gestionar.SuperAdministrador.editar', ['usuario' => $usuario]);
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
                $file->move(storage_path() . '/app/public/productos/', $file->getClientOriginalName());
                $file            = $request->file('imagen');
                $imagen          = $file->getClientOriginalName();
                $usuario->imagen = $imagen;
            }
            $usuario->save();
            $detalleBitacora = 'editó al usuario con ID:' . $usuario->id . ' con nombre: ' . $usuario->name . ' y apellidos: ' . $usuario->apellidos;
            Bitacora::registrarBitacora(2, $detalleBitacora);
            \Session::flash('flash_message', 'El administrador se editó correctamente');
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return Redirect::to('/super/listar');
    }

    public function ver($id)
    {
        //activado = 1 ;desactivado =1 ;eliminado=2;
        $usuario  = User::findOrFail($id);
        $empresas = Empresa::get();
        return view('Gestionar.SuperAdministrador.ver', ['usuario' => $usuario]);
    }

    public function eliminar($id)
    {
        $usuario         = User::find($id);
        $detalleBitacora = 'eliminó al administrador con ID:' . $usuario->id . ' con nombre: ' . $usuario->name . ' y apellidos: ' . $usuario->apellidos;
        Bitacora::registrarBitacora(4, $detalleBitacora);
        $usuario->delete();
        \Session::flash('flash_message', 'El administrador se eliminó correctamente');
        return Redirect::to('/super/listar');
    }
}
