<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table      = 'users';
    protected $primaryKey = 'id';
    public $timestamps    = false;
    protected $fillable   = [
        'name', 'email', 'password', 'idrol', 'estado', 'ci', 'telefono', 'imagen', 'fechanacimiento', 'sexo', 'apellidos',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function rol()
    {
        return $this->belongsTo('App\Rol', 'idrol', 'id');
    }
    public static function asignarNavegacion()
    {
        if (Auth::guard('web')->check()) {
            if (Auth::guard('web')->user()->rol->id == 1) {
                return 'Administrador';
            } else if (Auth::guard('web')->user()->rol->id != 1 && Auth::guard('web')->user()->rol->id != 4) {
                return 'Empresa';
            } else if (Auth::guard('web')->user()->rol->id == 4) {
                return 'SuperAdministrador';
            }
        }
        if (Auth::guard('cliente')->check()) {
            return 'Cliente';
        }

    }
    public static function restringirEliminar()
    {
        return auth()->check() ? auth()->user()->idrol : 'Cliente';
    }
    //Relaciones eloquent
    // public function usuarioempresas(){
    //     return $this->hasMany('App\Usuarioempresa','idusuario','id');
    //}
    public function usuarioempresa()
    {
        return $this->hasOne('App\Usuarioempresa', 'idusuario', 'id');
    }
    public function repartidor()
    {
        return $this->hasOne('App\Repartidor', 'idusuario', 'id');
    }

}
