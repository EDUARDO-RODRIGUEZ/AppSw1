<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bitacora;
class BitacoraController extends Controller
{
    public function listar(Request $request){
    	$bitacoras = Bitacora::where('idusuario','like',$request->get('id').'%')->paginate(8);
    	return view('Gestionar.Bitacora.inicio',['bitacoras'=>$bitacoras]);
    }
}
