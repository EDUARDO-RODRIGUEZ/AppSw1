<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $table = 'subcategoria';
    protected $primaryKey ='id';
    public $timestamps = false;

    protected $fillable =[
    	'nombre','descripcion','color','imagen','idcategoria'
    ];
    protected $guarded=[   	
    ];
    public function categoria(){
    	return $this->BelongsTo('App\Categoria','idcategoria','id');
    }
    public function productos(){
        return $this->hasMany('App\Producto','idsubcategoria','id');
    }

}
