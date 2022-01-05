<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ClienteAuthenticate as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class Cliente extends Authenticatable
{
    protected $table = 'cliente';
    protected $primaryKey ='id';
    public $timestamps = false;

    protected $fillable =[
    	'nombres','email','password','apellidos','estado','ci','fechanacimiento','telefono','sexo','token','verificado','imagen'
    ];
    protected $guarded=[   	
    ];
        protected $hidden = [
        'password'
    ];

    public function direcciones()
    {
       return $this->hasMany('App\Direccion', 'idcliente','id');
    }
}
