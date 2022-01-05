<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarioempresa extends Model
{
    protected $table = 'usuarioempresa';
    protected $primaryKey ='id';
    public $timestamps = false;

    protected $fillable =[
    	'idusuario','idempresa','estado'
    ];
    protected $guarded=[   	
    ];
    public function empresa(){
    	return $this->belongsTo('App\Empresa','idempresa','id');
    }
    public function usuario(){
        return $this->belongsTo('App\User','idusuario','id');
    }

}
