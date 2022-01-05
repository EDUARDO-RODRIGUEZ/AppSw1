<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{

    protected $table      = 'revision';
    protected $primaryKey = 'id';
    public $timestamps    = false;

    protected $fillable = [
        'valoracion', 'idpedido', 'idcliente', 'reseña',
    ];
    protected $guarded = [
    ];
    public function pedido()
    {
        return $this->BelongsTo('App\Pedido', 'idpedido', 'id');
    }

}
