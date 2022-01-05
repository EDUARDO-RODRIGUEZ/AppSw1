<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolPrivilegio extends Model
{
    protected $table = 'rol_privilegio';
    protected $primaryKey ='id';
    public $timestamps = false;

    protected $fillable =[
    	'idrol','idprivilegio','eliminado'
    ];
    protected $guarded=[   	
    ];
    public function privilegio(){
    	return $this->BelongsTo('App\Privilegio','idprivilegio','id');
    }
}
