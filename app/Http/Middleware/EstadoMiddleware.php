<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;
class EstadoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {      if (Auth::guard('web')->check() && Auth::guard('web')->user()->estado==0) {
                Auth::guard('web')->logout();
                \Session::flash('estadoPersonal','Su cuenta ha sido bloqueada, porfavor contactar con los administradores');
            return redirect('/');
           }else if(Auth::guard('cliente')->check() && Auth::guard('cliente')->user()->estado==0){
            \Session::flash('estadoCliente','Su cuenta ha sido bloqueada, porfavor contactar con los administradores');
                Auth::guard('cliente')->logout();
            return redirect('/');
           }
            return $next($request);
    }
}

