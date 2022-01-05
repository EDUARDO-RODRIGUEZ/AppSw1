<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    protected $table      = 'categoria';
    protected $primaryKey = 'id';
    public $timestamps    = false;

    protected $fillable = [
        'nombre', 'descripcion', 'imagen', 'color',
    ];
    protected $guarded = [
    ];

    public function productos()
    {
        return $this->hasMany('App\Producto', 'id_categoria', 'id');
    }
    public function subcategorias()
    {
        return $this->hasMany('App\Subcategoria', 'idcategoria', 'id');
    }
    public function listarcategorias()
    {
        $categorias = Categoria::with('subcategorias')->get();
        return $categorias;
    }
}
