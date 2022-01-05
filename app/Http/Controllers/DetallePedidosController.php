<?php

namespace App\Http\Controllers;

use App\DetallePedido;
use App\Revision;
use Illuminate\Http\Request;

class DetallePedidosController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function detalleDePedido($idpedido)
    {
        $detallesDelPedido = DetallePedido::where('idpedido', '=', $idpedido)->get();
        $revision          = Revision::where('idpedido', $idpedido)->first();
        return view('Gestionar.DetallePedido.ver', ['detallesDelPedido' => $detallesDelPedido, 'revision' => $revision]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
