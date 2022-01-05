<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Cliente;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Mail;

class ClienteController extends Controller
{
    public function index()
    {
        return view('layout.plantilla');
    }

    public function login(Request $request)
    {
        if (Auth::guard('cliente')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('cliente')->user();

            return Redirect::to('/');
        } else {
            \Session::flash('incorrecto', 'El email o contraseña son incorrectos');

            return Redirect::to('/');
        }
    }

    public function salir()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    public function listar(Request $request)
    {
        $clientes = Cliente::where('nombres', 'like', $request->get('nombre') . '%')->paginate(6);
        return view('Gestionar.Cliente.inicio', ['clientes' => $clientes]);
    }
    public function formularioRegistro()
    {
        return view('Gestionar.Cliente.registrar');
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
                'nombres'         => 'required',
                'apellidos'       => 'required',
                'email'           => 'required|email|unique:Cliente',
                'contraseña'      => 'required',
                'ccontraseña'     => 'required|same:contraseña',
                'telefono'        => 'required|max:8|min:8',
                'sexo'            => 'required',
                'fechanacimiento' => "required|date|before_or_equal:" . Carbon::now()->subYears(18)->format("Y-m-d"),
            ], $messages);

            $cliente                  = new CLiente;
            $cliente->email           = $request->get('email');
            $cliente->nombres         = $request->get('nombres');
            $cliente->apellidos       = $request->get('apellidos');
            $cliente->password        = Hash::make($request->get('contraseña'));
            $cliente->telefono        = $request->get('telefono');
            $cliente->fechanacimiento = $request->get('fechanacimiento');
            $cliente->token           = bin2hex(random_bytes(30));
            $subject                  = "Verificacion de correo electronico";
            $cliente->verificado      = 0;
            $cliente->estado          = 1;
            $cliente->sexo            = $request->get('sexo');
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $file->move(storage_path() . '/app/public/productos/', $file->getClientOriginalName());
                $file            = $request->file('imagen');
                $imagen          = $file->getClientOriginalName();
                $cliente->imagen = $imagen;
            }
            $for  = $cliente->email;
            $data = array('nombreCliente' => $cliente->nombre, 'token' => $cliente->token);

            Mail::send('Email.verificacion', $data, function ($msj) use ($subject, $for) {
                $msj->from("homemarket.info1@gmail.com", "Home Market");
                $msj->subject($subject);
                $msj->to($for);
            });
            $cliente->save();
            $detalleBitacora = 'El cliente con ID:' . $cliente->id . ' con nombre: ' . $cliente->name . ' y apellidos: ' . $cliente->apellidos . ' se registró';
            Bitacora::registrarBitacoras(3, $detalleBitacora);
            \Session::flash('flash', 'Se registró correctamente , porfavor verifique su gmail');

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return Redirect::to('/');
    }

    public function cambiarEstado($id, $estado)
    {
        //activado = 1 ;desactivado =1 ;eliminado=2;

        $cliente         = Cliente::findOrFail($id);
        $cliente->estado = $estado;
        $cliente->save();
        $detalleBitacora = 'actualizó el estado del cliente con ID:' . $cliente->id . ' con nombre: ' . $cliente->name . ' y apellidos: ' . $cliente->apellidos;
        Bitacora::registrarBitacora(2, $detalleBitacora);
        \Session::flash('flash_message', 'Se actualizó el estado correctamente');
        return Redirect::to('/cliente/listar');
    }
    public function ver($id)
    {
        //activado = 1 ;desactivado =1 ;eliminado=2;
        $cliente = Cliente::findOrFail($id);
        return view('Gestionar.Cliente.ver', ['cliente' => $cliente]);
    }

}
