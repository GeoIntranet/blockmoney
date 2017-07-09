<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        $autorize = auth()->id() == 1 ? TRUE : FALSE;

        if($autorize == TRUE)
        {
            return $next($request);
        }
        else{
            return ['Vous n\'etes pas autoriser a accéder a cette section'];
        }
    }
}
