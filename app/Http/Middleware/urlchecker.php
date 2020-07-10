<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;

class urlchecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$para)
    {
        // if ($request->route('companyID')) {
        //     $company = Company::find($request->route('companyID'));
        //     if ($company && $company->user_id != auth()->user()->id) {
        //         return redirect('/');
        //     }
        // }

        // dd($request->route()->parameters()['id']);
        if($request->session()->has('supplier')){
            if($para){
                if ($request->session()->get('supplier')['supplier_id'] == $request->route($para)) {
                    return $next($request);
                }
                return redirect()->back();
            }
            return $next($request);
            
        }
        return redirect('/');
       
      
    }
}
