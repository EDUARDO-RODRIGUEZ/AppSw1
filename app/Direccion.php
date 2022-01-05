<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table      = 'direccion';
    protected $primaryKey = 'id';
    public $timestamps    = false;

    protected $fillable = [
        'idcliente', 'nombre', 'longitud', 'latitud', 'calle', 'referencia',
    ];
    protected $guarded = [
    ];
    protected $hidden = [
        'password',
    ];

}
