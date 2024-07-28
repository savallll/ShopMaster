<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthAdmin 
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle($request, Closure $next)
    {
        // dd((auth()->user()->roles));
        if(!Auth::check()){
            return redirect()->route('auth.index');
        }
        foreach(auth()->user()->userType as $item){
            if($item->name == 'Admin'){
                return $next($request);
            }
        }
        return redirect()->route('client.home');

    }
}
