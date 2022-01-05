<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Categoria;
use App\Empresa;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class EmpresaController extends Controller
{
    public function listar(Request $request)
    {
        //desactivar = 0;
        //activar = 1;
        //eliminar = 2;
        $empresas = Empresa::where('nombre', 'LIKE', '%' . $request->nombre . '%')->get();
        return view('Gestionar.Empresa.inicio', ['empresas' => $empresas]);
    }
    public function formularioRegistro()
    {

        return view('Gestionar.Empresa.registrar');
    }
    public function registrar(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'nombre'        => 'required',
                'descripcion'   => 'required',
                'representante' => 'required',
                'telefono'      => 'required',
                'imagen'        => 'required',
                'direccion'     => 'required',
                'comision'      => 'required|numeric|max:100|min:0',
            ]);

            $empresa                = new Empresa;
            $empresa->nombre        = $request->get('nombre');
            $empresa->descripcion   = $request->get('descripcion');
            $empresa->representante = $request->get('representante');
            $empresa->telefono      = $request->get('telefono');
            $empresa->direccion     = $request->get('direccion');
            $empresa->comision      = $request->get('comision');
            $empresa->totalcomision = 0;
            $file                   = $request->file('imagen');
            $file->move(storage_path() . '/app/public/empresas/', $file->getClientOriginalName());
            $file            = $request->file('imagen');
            $imagen          = $file->getClientOriginalName();
            $empresa->imagen = $imagen;
            $empresa->save();
            $detalleBitacora = 'registro la empresa con ID:' . $empresa->id . ' con nombre: ' . $empresa->nombre;
            Bitacora::registrar(3, $detalleBitacora);
            \Session::flash('flash_message', 'La empresa se registró correctamente');
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return Redirect::to('/empresa/listar');
    }

    public function devolverDatos($id)
    {
        $empresa = Empresa::findOrFail($id);
        return view('Gestionar.Empresa.editar', ['empresa' => $empresa]);
    }

    public function editar(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'nombre'        => 'required',
                'descripcion'   => 'required',
                'representante' => 'required',
                'telefono'      => 'required',
                'direccion'     => 'required',
                'comision'      => 'required|numeric|max:100|min:0',
            ]);

            $empresa                = Empresa::findOrFail($id);
            $empresa->nombre        = $request->get('nombre');
            $empresa->descripcion   = $request->get('descripcion');
            $empresa->representante = $request->get('representante');
            $empresa->telefono      = $request->get('telefono');
            $empresa->direccion     = $request->get('direccion');
            $empresa->comision      = $request->get('comision');
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $file->move(storage_path() . '/app/public/empresas/', $file->getClientOriginalName());
                $file            = $request->file('imagen');
                $imagen          = $file->getClientOriginalName();
                $empresa->imagen = $imagen;
            }
            $empresa->save();
            $detalleBitacora = 'editó la empresa con ID:' . $empresa->id . ' con nombre: ' . $empresa->nombre;
            Bitacora::registrar(3, $detalleBitacora);
            \Session::flash('flash_message', 'La empresa se editó correctamente');
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return Redirect::to('/empresa/listar');
    }

    public function eliminar($id)
    {
        $empresa         = Empresa::find($id);
        $detalleBitacora = 'eliminó la empresa con ID:' . $empresa->id . ' con nombre: ' . $empresa->nombre;
        Bitacora::eliminar(4, $detalleBitacora);
        $empresa->delete();
        \Session::flash('flash_message', 'La empresa se eliminó correctamente');
        return Redirect::to('/empresa/listar');
    }
    public function listarCliente()
    {
        $Categorias = Categoria::where('estado', '!=', '2')->get();
        return view('Contenido.categorias', ['Categorias' => $Categorias]);
    }
}
