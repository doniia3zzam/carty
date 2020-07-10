<?php

namespace App\Http\Middleware;

use Closure;

class redirectIflogin
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
        if($request->session()->has('supplier')){
            return redirect('home');
        }
        return $next($request);
        
    }
}
