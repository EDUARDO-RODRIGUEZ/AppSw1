<?php

namespace App;

use App\Pedido;
use App\Producto;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $table      = 'detallepedido';
    protected $primaryKey = 'id';
    public $timestamps    = false;
    protected $fillable   = [
        'idpedido', 'idproducto', 'cantidad', 'precio', 'subtotal', 'comision','calificado','promedio','calificacion','comentario',
    ];
    protected $guarded = [
    ];
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'idpedido', 'id');
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idproducto', 'id');
    }
}
