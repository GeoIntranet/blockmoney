<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class app
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
        $autorize = Auth::user()->ready == 1 ? TRUE : FALSE;

        if($autorize == TRUE)
        {
            return $next($request);
        }
        else{
            return redirect()->action('UserController@profil',Auth::user()->id);
        }
    }
}
