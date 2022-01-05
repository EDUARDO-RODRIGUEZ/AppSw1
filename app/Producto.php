<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categoria;
use App\Revision;
class Producto extends Model
{
    protected $table = 'producto';
    protected $primaryKey ='id';
    public $timestamps = false;

    protected $fillable =[
        'nombre','stock','precio','imagen','descripcion','estado','idsubcategoria','idempresa','promocion','idpromocion'
    ];
    protected $guarded=[   	
    ];
    public function pathAttachment(){
        return ('/imagenes/productos/'.$this->imagen);
    }
   public function categoria()
    {
        return $this->belongsTo(Categoria::class,'id_categoria','id');
    }
    public function empresa()
    {
        return $this->belongsTo(Empresa::class,'idempresa','id');
    }
    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class,'idsubcategoria','id');
    }
    public function promocion()
    {
        return $this->belongsTo(Promocion::class,'idpromocion','id');
    }
 	public function vendedor()
    {
        return $this->belongsTo(Vendedor::class,'id_vendedores','id');
    }
    public function revisiones()
    {
        return $this->hasMany(Revision::class,'idproducto','id');
    }
    public function getPromedioAttribute()
    {
        return $this->revisiones->avg('valoracion');
    }
    public function getDescontadoAttribute()
    {       
        return $this->promocion->whereHas('promocion',function($q){
            $q->select('descuento');
        });
    }
}
