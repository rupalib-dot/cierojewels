<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class SellerDetailsVerification
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
        if(Auth::user()->user_type == 'admin' || (Auth::user()->user_type == 'seller'  && Auth::user()->seller_detail_verification === '1')){
                return $next($request);
        }else{
            return redirect('admin/home');
        }
        
    }
}
