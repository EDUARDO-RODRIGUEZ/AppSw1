<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privilegio extends Model
{
    protected $table = 'privilegio';
    protected $primaryKey ='id';
    public $timestamps = false;

    protected $fillable =[
    	'nombre','descripcion'
    ];
    protected $guarded=[   	
    ];
}
