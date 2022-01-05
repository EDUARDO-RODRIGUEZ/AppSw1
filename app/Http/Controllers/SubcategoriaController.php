<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subcategoria;
use App\Categoria;
use App\User;
use App\Bitacora;
use App\Empresa;
use App\Usuarioempresa;
use Carbon\Carbon;
use DB;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
class SubcategoriaController extends Controller
{
  
   public function listar(Request $request){

       $Subcategorias = Subcategoria::where('nombre','like',$request->get('nombre').'%')->paginate(6);
      return view('Gestionar.Subcategoria.inicio',['Subcategorias'=>$Subcategorias]);
   }



   public function formularioRegistro(){
      $categorias = Categoria::get();
      return view('Gestionar.Subcategoria.registrar',['Categorias'=>$categorias]);
   }



   public function registrar(Request $request){
      DB::beginTransaction();
      try{
            $this->validate($request, [
        'nombre' => 'required',
        'descripcion' => 'required',
        'categoria' => 'required',
        'imagen' => 'required',
        'color' => 'required'
    ]);
         $subcategoria = new Subcategoria;
         $subcategoria->nombre = $request->get('nombre');
         $subcategoria->descripcion = e($request->get('descripcion'));
         $subcategoria->color = $request->get('color');
         $subcategoria->idcategoria = $request->get('categoria');
          if($request->hasFile('imagen')){
            $file=$request->file('imagen');
            $file->move(storage_path().'/app/public/productos/',$file->getClientOriginalName());
            $file=$request->file('imagen');
            $imagen = $file->getClientOriginalName();
            $subcategoria->imagen=$imagen;
          }
         $subcategoria->save();
         $detalleBitacora = 'registró la subcategoria con ID:'. $subcategoria->id .' con nombre: ' . $subcategoria->nombre;
         Bitacora::registrar(3,$detalleBitacora);
         \Session::flash('flash_message','La subcategoria se registró correctamente');
         DB::commit();

      }catch(Exception $e){
         DB::rollback();
      }
      return Redirect::to('/subcategoria/listar');
    }
   
    public function devolverDatos($id){
      $subcategoria = Subcategoria::findOrFail($id);
       $categorias = Categoria::select('id','nombre')->get();
      return view('Gestionar.Subcategoria.editar',['subcategoria' => $subcategoria,'Categorias' =>$categorias]);
   }
   public function inicio(){
      return view('Gestionar.Subcategoria.inicio');
   }
   public function editar(Request $request,$id){
      DB::beginTransaction();
      try{
            $this->validate($request, [
        'nombre' => 'required',
        'descripcion' => 'required',
        'categoria' => 'required',
        'color' => 'required'
    ]);
         $subcategoria =Subcategoria::findOrFail($id);
         $subcategoria->nombre = $request->get('nombre');
         $subcategoria->descripcion = e($request->get('descripcion'));
         $subcategoria->color = $request->get('color');
         $subcategoria->idcategoria = $request->get('categoria');
          if($request->hasFile('imagen')){
            $file=$request->file('imagen');
            $file->move(storage_path().'/app/public/productos/',$file->getClientOriginalName());
            $file=$request->file('imagen');
            $imagen = $file->getClientOriginalName();
            $subcategoria->imagen=$imagen;
          }
         $subcategoria->save();
         $detalleBitacora = 'editó la subcategoria con ID:'. $subcategoria->id .' con nombre: ' . $subcategoria->nombre;
         Bitacora::editar(2,$detalleBitacora);
         \Session::flash('flash_message','La subcategoria se editó correctamente');
         DB::commit();
      }catch(Exception $e){
         DB::rollback();
      }
      return Redirect::to('/subcategoria/listar');
   }


   public function ver($id){
      //activado = 1 ;desactivado =1 ;eliminado=2;
      $subcategoria=Subcategoria::findOrFail($id);
      return view('Gestionar.Subcategoria.ver',['subcategoria'=>$subcategoria]);
   }




   public function eliminar($id){
       $subcategoria = Subcategoria::find($id);
       $detalleBitacora = 'eliminó la subcategoria con ID:'. $subcategoria->id .' con nombre: ' . $subcategoria->nombre;
         Bitacora::eliminar(4,$detalleBitacora);
        $subcategoria->delete();
        \Session::flash('flash_message','La subcategoria se eliminó correctamente');
        return Redirect::to('/subcategoria/listar');
    } 
      public function listarCliente(){
      $Categorias = Subcategoria::where('estado','!=','2')->get();
      return view('Contenido.categorias',['Categorias'=>$Categorias]);
   }

}
