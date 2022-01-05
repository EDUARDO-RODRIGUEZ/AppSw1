<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresa';
    protected $primaryKey ='id';
    public $timestamps = false;
    protected $appends=['productos_formatted'];
    protected $fillable =[
    	'direccion','nombre','descripcion','estado','representante','telefono','imagen','comision','totalcomision'
    ];
    protected $guarded=[   	
    ];
    public function productos()
    {
       return $this->hasMany('App\Producto', 'idempresa','id');
    }
    public function repartidores()
    {
       return $this->hasMany('App\Repartidor', 'idempresa','id');
    }
    public function pedidos()
    {
       return $this->hasMany('App\Pedido', 'idempresa','id');
    }
    public function promociones()
    {
       return $this->hasMany('App\Promocion', 'idempresa','id');
    }
    public function usuarioempresas()
    {
       return $this->hasMany('App\Usuarioempresa', 'idempresa','id');
    }
    public function getProductosFormattedAttribute(){
        return '<li>'.$this->productos->where('estado','1')->pluck('nombre')->implode('</li><li>').'</li>';
    }
}
