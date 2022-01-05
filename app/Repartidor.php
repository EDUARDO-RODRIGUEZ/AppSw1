<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repartidor extends Model
{
    
    protected $table = 'repartidor';
    protected $primaryKey ='id';
    public $timestamps = false;
    protected $fillable =[
    	'idusuario','nombre','idempresa'
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
