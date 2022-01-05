<?php

namespace App\Http\Controllers;
use App\Promocion;
use App\Empresa;
use App\Subcategoria;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
     public function inicioEmpresa(){
      return view('Gestionar.promocionEmpresa.inicio');
    }
    public function listarPromociones(Request $request){
       $filtro = $request->get('filter_gender');
      if($filtro == 0){
          $promociones=Promocion::where('idempresa',auth()->user()->usuarioempresas->first()->idempresa)->where('estado','0')->get();
         }
      if($filtro==1){
          $promociones=Promocion::where('idempresa',auth()->user()->usuarioempresas->first()->idempresa)->where('estado','1')->get();
      }
      if($filtro==3){
          $promociones=Promocion::where('idempresa',auth()->user()->usuarioempresas->first()->idempresa)->where('estado','!=','2')->get();
      }
      $acciones = 'Gestionar.datatables.AccionP';
      $estados = 'Gestionar.datatables.EstadoP';
      return \DataTables()::of($promociones)->addColumn('accion',$acciones)->addColumn('estado',$estados)->rawColumns(['accion','estado'])->toJson();
    }

    public function Listar($id,Request $request){
    	$subcategorias = Producto::withCount('revisiones')->with('subcategoria','empresa')->where('idsubcategoria' , $id)->whereHas('empresa',function($q) use($request){
    		$q->where('id','like',$request->get('empresita').'%')->where('nombre','like','%'.$request->get('buscarempresa').'%');
    	})->paginate(9);
    	$resultados = $subcategorias->count();
    	$subcategorio =Producto::with('subcategoria')->where('idsubcategoria' , $id)->get()->first();
    	$empresas = Empresa::with('productos')->whereHas('productos',function($q) use($id){
    		$q->where('idsubcategoria',$id);
    	})->get();
    
    	$categorias= Categoria::with('subcategorias')->get();
    	return view('contenido.productos' ,['subcategorias'=>$subcategorias,'categorias'=>$categorias,'subcategorio'=>$subcategorio,'empresas'=>$empresas,'resultados'=>$resultados]);
    }
    public function listarDetalle($id){
        $producto = Producto::with('empresa','subcategoria.categoria')->findOrFail($id);
        return response()->json(['producto'=>$producto,'promedio'=>$producto->promedio]);
    }

    public function registrar(Request $request){
      DB::beginTransaction();
      try{
        $rules = array(
         'nombre' => 'required|max:50',
        'descripcion' => 'required',
        'subcategoria' =>'required',
        'empresa' =>'required',
        'imagen' =>'required',
        'stock' =>'required',
        'precio' =>'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
         $producto = new Producto;
         $producto->nombre = $request->get('nombre');
         $producto->descripcion = $request->get('descripcion');
         $producto->idsubcategoria = $request->get('subcategoria');
         $producto->idempresa = $request->get('empresa');
         $producto->precio = $request->get('precio');
         $producto->stock = $request->get('stock');
         $producto->estado=1;
          if($request->hasFile('imagen')){
            $file=$request->file('imagen');
            $file->move(storage_path().'/app/public/productos/',$file->getClientOriginalName());
            $file=$request->file('imagen');
            $imagen = $file->getClientOriginalName();
            $producto->imagen=$imagen;
          }

         $producto->save();
         DB::commit();
      }catch(Exception $e){
         DB::rollback();
      }
      return response()->json('correcto');
   }
   public function listarProductos(Request $request){
      $filtro = $request->get('filter_gender');
      if($filtro == 0){
                   $productos = Producto::with('empresa','subcategoria')->whereHas('empresa',function($q){
                $q->where('estado',1);
            })->whereHas('subcategoria',function($q){
                $q->where('estado',1);
            })->where('estado',0)->get();
         }
      if($filtro==1){
                   $productos = Producto::with('empresa','subcategoria')->whereHas('empresa',function($q){
                $q->where('estado',1);
            })->whereHas('subcategoria',function($q){
                $q->where('estado',1);
            })->where('estado',1)->get();
         }
      if($filtro==3){
       $productos = Producto::with('empresa','subcategoria')->whereHas('empresa',function($q){
                $q->where('estado',1);
            })->whereHas('subcategoria',function($q){
                $q->where('estado',1);
            })->where('estado','!=','2')->get();
      }
      
      
      //dd($usuarios);
      $acciones = 'Gestionar.datatables.AccionP';
      $estados = 'Gestionar.datatables.EstadoP';
      $imagenes = 'Gestionar.datatables.ImagenP';
      return \DataTables()::of($productos)->addColumn('accion',$acciones)->addColumn('estado',$estados)->addColumn('imagencita',$imagenes)->rawColumns(['accion','estado','imagencita'])->toJson();
   }
    public function devolverDatos($id){
      $dato = Producto::with('subcategoria','empresa')->findOrFail($id);
      return response()->json(['dato' => $dato]);
   }
   public function inicio(){
      $empresas = Empresa::where('estado',1)->get();
      $subcategorias = Subcategoria::where('estado',1)->get();
      return view('Gestionar.Producto.inicio',['empresas'=>$empresas,'subcategorias'=>$subcategorias]);
   }
   public function guardar(Request $request,$id){
       DB::beginTransaction();
      try{
        $rules = array(
         'nombre' => 'required|max:50',
        'descripcion' => 'required',
        'subcategoria' =>'required',
        'empresa' =>'required',
        'stock' =>'required',
        'precio' =>'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
         $producto = Producto::findOrFail($id);
         $producto->nombre = $request->get('nombre');
         $producto->descripcion = $request->get('descripcion');
         $producto->idsubcategoria = $request->get('subcategoria');
         $producto->idempresa = $request->get('empresa');
         $producto->precio = $request->get('precio');
         $producto->stock = $request->get('stock');
          if($request->hasFile('imagen')){
            $file=$request->file('imagen');
            $file->move(storage_path().'/app/public/productos/',$file->getClientOriginalName());
            $file=$request->file('imagen');
            $imagen = $file->getClientOriginalName();
            $producto->imagen=$imagen;
          }
         $producto->save();
         DB::commit();
      }catch(Exception $e){
         DB::rollback();
      }
      return response()->json('correcto');
   }
   public function cambiarEstado($id,$estado){
      //activado = 1 ;desactivado =1 ;eliminado=2;
      $producto=Producto::findOrFail($id);
      $producto->estado=$estado;
      $producto->save();
      return response()->json("Correcto");
   }

}
