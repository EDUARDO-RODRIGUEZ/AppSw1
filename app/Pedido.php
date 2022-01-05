<?php

namespace App;

use App\Empresa;
use App\Revision;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public static $PENDIENTE  = 1;
    public static $CAMINO     = 2;
    public static $DESTINO    = 3;
    public static $FINALIZADO = 4;
    public static $CANCELADO  = 5;

    protected $table      = 'pedido';
    protected $primaryKey = 'id';
    public $timestamps    = false;
    protected $fillable   = [
        'idcliente', 'idempresa', 'idrepartidor', 'comision', 'total', 'latitud', 'longuitud', 'fecha', 'hora', 'nit', 'referencia', 'calle', 'razonSocial', 'estado', 'estadopedidoactual', 'tipodepago', 'fechahora',
    ];
    protected $guarded = [
    ];
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'idempresa', 'id');
    }
    public function detallePedidos()
    {
        return $this->belongsToMany('App\Producto', 'App\DetallePedido', 'idpedido', 'idproducto');
    }
    public function detallesPedido()
    {
        return $this->hasMany('App\DetallePedido', 'idpedido', 'id');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'idcliente', 'id');
    }

    public function repartidor()
    {
        return $this->belongsTo('App\Repartidor', 'idrepartidor', 'id');
    }
    /**
     * Pedido has one Revision.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function revision()
    {
        // hasOne(RelatedModel, foreignKeyOnRelatedModel = pedido_id, localKey = id)
        return $this->hasOne(Revision::class, 'idpedido', 'id');
    }

}
