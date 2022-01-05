<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cobro extends Model
{
    protected $table = 'cobro';
    protected $primaryKey ='id';
    public $timestamps = false;
    protected $appends=['productos_formatted'];
    protected $fillable =[
    	'idempresa','monto','fecha','totalAnterior','totalActual'
    ];
    protected $guarded=[   	
    ];
    public function empresa()
    {
        return $this->belongsTo(Empresa::class,'idempresa','id');
    }
}
