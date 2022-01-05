<?php

namespace App\Http\Controllers;

use App\Direccion;
use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;

class DireccionController extends Controller
{
    public function indiceDireccion()
    {
        return view('Gestionar.Direccion.clienteDireccion');
    }

    public function listar()
    {
        $direcciones = Direccion::where("idcliente", Auth::guard('cliente')->user()->id)->paginate(6);
        return view('Gestionar.Direccion.inicio', ['direcciones' => $direcciones]);
    }
    public function formularioRegistro()
    {

        return view('Gestionar.Direccion.registrar');
    }
    public function registrar(Request $request)
    {
        $rules = array(
            'nombre'     => 'required',
            'calle'      => 'required',
            'referencia' => 'required',
            'longuitud'  => 'required',
            'latitud'    => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all(), 'success' => false]);
        }
        $direccion             = new Direccion;
        $direccion->nombre     = $request->get('nombre');
        $direccion->calle      = $request->get('calle');
        $direccion->referencia = $request->get('referencia');
        $direccion->latitud    = $request->get('latitud');
        $direccion->longitud   = $request->get('longuitud');
        $direccion->idcliente  = Auth::guard('cliente')->user()->id;
        $direccion->save();
        return response()->json(['success' => true]);
    }
    public function devolverDatos($id)
    {
        $direccion = Direccion::findOrFail($id);
        return view('Gestionar.Direccion.editar', ['direccion' => $direccion]);
    }

    public function editar(Request $request, $id)
    {
        $rules = array(
            'nombre'     => 'required',
            'calle'      => 'required',
            'referencia' => 'required',
            'longuitud'  => 'required',
            'latitud'    => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all(), 'success' => false]);
        }
        $direccion             = Direccion::findOrFail($id);
        $direccion->nombre     = $request->get('nombre');
        $direccion->calle      = $request->get('calle');
        $direccion->referencia = $request->get('referencia');
        $direccion->latitud    = $request->get('latitud');
        $direccion->longitud   = $request->get('longuitud');
        $direccion->save();
        return response()->json(['success' => true]);
    }

    public function eliminar($id)
    {
        $direccion = Direccion::find($id);
        $direccion->delete();
        \Session::flash('flash_message', 'La direccion se eliminó correctamente');
        return Redirect::to('/direccion/listar');
    }

    public function listarDireccion()
    {
        $direcciones = Direccion::where("idcliente", Auth::guard('cliente')->user()->id)->paginate(6);
        return view('Gestionar.AsignarDireccion.inicio', ['direcciones' => $direcciones]);

    }
    public function asignar($id)
    {
        $direccion = Direccion::findOrFail($id);
        \Session::forget('longuitud');
        \Session::forget('latitud');
        \Session::forget('referencia');
        \Session::forget('calle');
        \Session::push('longuitud', $direccion->longitud);
        \Session::push('latitud', $direccion->latitud);
        \Session::push('referencia', $direccion->referencia);
        \Session::push('calle', $direccion->calle);
        return Redirect::to('realizarPedido/formularioDireccion');
    }
}
