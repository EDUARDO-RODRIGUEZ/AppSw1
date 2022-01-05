<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;
class VerificarMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
          if(Auth::guard('cliente')->check() && Auth::guard('cliente')->user()->verificado==0){
                Auth::guard('cliente')->logout();
            return redirect('/mensaje');
           }
            return $next($request);
    }
}
