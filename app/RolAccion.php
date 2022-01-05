<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolAccion extends Model
{
    protected $table = 'rol_accion';
    protected $primaryKey ='id';
    public $timestamps = false;

    protected $fillable =[
    	'idrol','idaccion','eliminado'
    ];
    protected $guarded=[   	
    ];
    public function accion(){
    	return $this->BelongsTo('App\Accion','idaccion','id');
    }
    public static function  registrar($id){
        $accion = new RolAccion;
        $accion->eliminado = 0;
        $accion->idrol=$id;
        $accion->idaccion=2;
        $accion->save();
    }
    
}
