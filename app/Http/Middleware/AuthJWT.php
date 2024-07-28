<?php

namespace App\Http\Middleware;


use Closure;
// use JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if ($request->hasCookie('jwt_token')) {
            $token = $request->cookie('jwt_token');
            $request->headers->set('Authorization', 'Bearer ' . $token);

            // Xác thực token
            try {
                $user = JWTAuth::parseToken()->authenticate();
                if($user){
                    return $next($request);
                }                
            } catch (JWTException $e) {
                return redirect()->route('auth.index');
            }
        }else 
            return $next($request);

        
        // return redirect()->route('auth.index');
    }
}

