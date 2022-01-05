<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    protected $table      = 'accion';
    protected $primaryKey = 'id';
    public $timestamps    = false;

    protected $fillable = [
        'nombre', 'descripcion',
    ];
    protected $guarded = [
    ];
}
