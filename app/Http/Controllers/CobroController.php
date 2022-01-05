<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Validator;
use App\Empresa;
use App\Bitacora;
use App\Cobro;
use App\Rol;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
class CobroController extends Controller
{
    public function cobrar(Request $request , $id){
    	DB::beginTransaction();
      try{
      	$empresa = Empresa::findOrFail($id);
      	$usuario = Auth::guard('web')->user();
        $idusuario= $usuario->id;
         if($request->get('monto') > $empresa->totalcomision){
         	 \Session::flash('flash_message','No se puede cobrar dicho monto');
         	return Redirect::to('/empresa/listar');
         }
         $totalComision = $empresa->totalcomision;
         $fechahora = Carbon::now()->timezone('America/La_Paz')->toDateTimeString();
         $cobro = new Cobro;
         $cobro->monto = $request->get('monto');
         //la deuda que le quedo a la empresa
         $cobro->totalAnterior = $totalComision ;
         $cobro->totalActual = $totalComision - $request->get('monto');
         $empresa->totalcomision = $totalComision - $request->get('monto');
         $empresa->save();
         $cobro->fecha = $fechahora;
         $cobro->idusuario = $idusuario;
          $cobro->idempresa = $empresa->id;
         $cobro->save();
          \Session::flash('flash_message','El cobro se realizó correctamente');
          $detalleBitacora = 'cobró a la empresa con ID:'. $empresa->id .' con nombre: ' . $empresa->nombre ;
         Bitacora::eliminar(5,$detalleBitacora);
         DB::commit();
      }catch(Exception $e){
         DB::rollback();
      }
      return Redirect::to('/empresa/listar');
    }

    public function listar(Request $request){
      $cobros = Cobro::where('idusuario','like',$request->get('id').'%')->paginate(8);
      return view('Gestionar.Cobro.inicio',['cobros'=>$cobros]);
    }
}
