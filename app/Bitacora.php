<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class Bitacora extends Model
{
    protected $table = 'bitacora';
    protected $primaryKey ='id';
    public $timestamps = false;

    protected $fillable =[
    	'id','idusuario','idtipobitacora','fechahora','detalle'
    ];
    protected $guarded=[   	
    ];
    protected $hidden = [
        'password'
    ];
    public function tipobitacoras()
    {
       return $this->hasMany('App\tipobitacora', 'idtipobitacora','id');
    }

    public static function  registrarBitacora($idtipobitacora, $detalle){
        $idusuario = Auth::guard('web')->user()->id;
        $usuarioLeageado = User::findOrFail($idusuario);
        
        $fechahora = Carbon::now()->timezone('America/La_Paz')->toDateTimeString();
        $bitacora = new Bitacora;
        $bitacora->idusuario = $idusuario;
        $bitacora->idtipobitacora = $idtipobitacora;
        $bitacora->fechahora = $fechahora;
        $bitacora->detalle = 'El usuario con id: '.$usuarioLeageado->id. ' '.$usuarioLeageado->name . ' '. $usuarioLeageado->apellido.' '.$detalle;
        $bitacora->save();
       
    }

    public static function eliminar($idtipobitacora, $detalle){
                $idusuario = Auth::guard('web')->user()->id;
        $usuarioLeageado = User::findOrFail($idusuario);
        
        $fechahora = Carbon::now()->timezone('America/La_Paz')->toDateTimeString();
        $bitacora = new Bitacora;
        $bitacora->idusuario = $idusuario;
        $bitacora->idtipobitacora = $idtipobitacora;
        $bitacora->fechahora = $fechahora;
        $bitacora->detalle = 'El usuario con id: '.$usuarioLeageado->id. ' '.$usuarioLeageado->name . ' '. $usuarioLeageado->apellidos.' '.$detalle;
        $bitacora->save();
    }
    public static function editar($idtipobitacora, $detalle){
                $idusuario = Auth::guard('web')->user()->id;
        $usuarioLeageado = User::findOrFail($idusuario);
        
        $fechahora = Carbon::now()->timezone('America/La_Paz')->toDateTimeString();
        $bitacora = new Bitacora;
        $bitacora->idusuario = $idusuario;
        $bitacora->idtipobitacora = $idtipobitacora;
        $bitacora->fechahora = $fechahora;
        $bitacora->detalle = 'El usuario con id: '.$usuarioLeageado->id. ' '.$usuarioLeageado->name . ' '. $usuarioLeageado->apellidos.' '.$detalle;
        $bitacora->save();
    }
    public static function registrar($idtipobitacora, $detalle){
        $idusuario = Auth::guard('web')->user()->id;
        $usuarioLeageado = User::findOrFail($idusuario);
        
        $fechahora = Carbon::now()->timezone('America/La_Paz')->toDateTimeString();
        $bitacora = new Bitacora;
        $bitacora->idusuario = $idusuario;
        $bitacora->idtipobitacora = $idtipobitacora;
        $bitacora->fechahora = $fechahora;
        $bitacora->detalle = 'El usuario con id: '.$usuarioLeageado->id. ' '.$usuarioLeageado->name . ' '. $usuarioLeageado->apellidos.' '.$detalle;
        $bitacora->save();
    }


    public static function  registrarBitacoras($idtipobitacora, $detalle){
        $fechahora = Carbon::now()->timezone('America/La_Paz')->toDateTimeString();
        $bitacora = new Bitacora;
        $bitacora->idusuario = 77;
        $bitacora->idtipobitacora = $idtipobitacora;
        $bitacora->fechahora = $fechahora;
        $bitacora->detalle = $detalle;
        $bitacora->save();
       
    }
    
}
