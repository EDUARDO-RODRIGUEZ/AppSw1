<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Categoria;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoriaController extends Controller
{

    public function listar(Request $request)
    {
        //desactivar = 0;
        //activar = 1;
        //eliminar = 2;
        $Categorias = Categoria::where('nombre', 'like', $request->get('nombre') . '%')->paginate(6);
        return view('Gestionar.Categoria.inicio', ['Categorias' => $Categorias]);
    }
    public function formularioRegistro()
    {

        return view('Gestionar.Categoria.registrar');
    }
    public function registrar(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'nombre'      => 'required',
                'descripcion' => 'required',
                'imagen'      => 'required',
                'color'       => 'required',
            ]);
            $categoria              = new Categoria;
            $categoria->nombre      = $request->get('nombre');
            $categoria->descripcion = e($request->get('descripcion'));
            $categoria->color       = $request->get('color');
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $file->move(storage_path() . '/app/public/productos/', $file->getClientOriginalName());
                $file              = $request->file('imagen');
                $imagen            = $file->getClientOriginalName();
                $categoria->imagen = $imagen;
            }
            $categoria->save();
            $detalleBitacora = 'registro la categoria con ID:' . $categoria->id . ' con nombre: ' . $categoria->nombre;
            Bitacora::registrar(3, $detalleBitacora);
            \Session::flash('flash_message', 'La categoria se registró correctamente');
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return Redirect::to('/categoria/listar');
    }

    public function devolverDatos($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('Gestionar.Categoria.editar', ['categoria' => $categoria]);
    }

    public function editar(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'nombre'      => 'required',
                'descripcion' => 'required',
                'color'       => 'required',
            ]);
            $categoria              = Categoria::findOrFail($id);
            $categoria->nombre      = $request->get('nombre');
            $categoria->descripcion = e($request->get('descripcion'));
            $categoria->color       = $request->get('color');
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $file->move(storage_path() . '/app/public/productos/', $file->getClientOriginalName());
                $file              = $request->file('imagen');
                $imagen            = $file->getClientOriginalName();
                $categoria->imagen = $imagen;
            }
            $categoria->save();
            $detalleBitacora = 'editó la categoria con ID:' . $categoria->id . ' con nombre: ' . $categoria->nombre;
            Bitacora::editar(2, $detalleBitacora);
            \Session::flash('flash_message', 'La categoria se editó correctamente');
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return Redirect::to('/categoria/listar');
    }

    public function ver($id)
    {
        //activado = 1 ;desactivado =1 ;eliminado=2;
        $categoria = Categoria::findOrFail($id);
        return view('Gestionar.Categoria.ver', ['categoria' => $categoria]);
    }

    public function eliminar($id)
    {
        $categoria       = Categoria::find($id);
        $detalleBitacora = 'eliminó la categoria con ID:' . $categoria->id . ' con nombre: ' . $categoria->nombre;
        Bitacora::eliminar(4, $detalleBitacora);
        $categoria->delete();
        \Session::flash('flash_message', 'La categoria se eliminó correctamente');
        return Redirect::to('/categoria/listar');
    }
    public function listarCliente()
    {
        $Categorias = Categoria::where('estado', '!=', '2')->get();
        return view('Contenido.categorias', ['Categorias' => $Categorias]);
    }
}
