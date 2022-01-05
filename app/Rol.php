<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{       public static $FINALIZADO = 4;
    public static $REPARTIDOR = 3;

    protected $table = 'rol';
    protected $primaryKey ='id';
    public $timestamps = false;

    protected $fillable =[
    	'nombre','descripcion'
    ];
    protected $guarded=[   	
    ];

    public function rolacciones()
    {
        return $this->hasMany('App\RolAccion', 'idrol', 'id');
    }
    public function rolprivilegioes()
    {
        return $this->hasMany('App\RolPrivilegio', 'idrol', 'id');
    }
    
    public static  $EMPRESA = 2;
    public static  $ADMINISTRADOR = 1;

}
