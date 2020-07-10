<?php

namespace App\Http\Middleware;
// use Illuminate\Support\Str;
use Closure;

class methodMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$routeMethod)
    {
        // var_dump($request->only('_method')['_method'] == $routeMethod);
        // $x = Str::of($routeMethod)->upper();
        // var_dump($request->all());
        
        if($request->only('_method')['_method'] == strtoupper($routeMethod)){
             return $next($request);
        }
         return redirect()->back();

       
    }
}
