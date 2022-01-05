<?php

namespace App\Http\Controllers;

use App\Revision;
use Cron\validate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RevisionController extends Controller
{
    public function formulario($id)
    {
        return view('Gestionar.Revision.registrar', ['id' => $id]);
    }
    public function valorar(Request $request, $id)
    {
        $this->validate($request, [
            'valoracion' => 'required',
            'reseña'     => 'required',
        ]);
        $idcliente              = Auth::guard('cliente')->user()->id;
        $valoracion             = new Revision;
        $valoracion->valoracion = $request->get('valoracion');
        $valoracion->reseña    = $request->get('reseña');
        $valoracion->idpedido   = $id;
        $valoracion->idcliente  = $idcliente;
        $valoracion->save();
        return Redirect::to('/gestionarPedido/cliente');
    }
}
