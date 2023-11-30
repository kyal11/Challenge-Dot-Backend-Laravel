<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        try {
            $token = cookie('jwt_token');

            if (!$token) {
                return redirect()->route('show-login')->with('error', 'Unauthorized. Please login again.');
            }
            $user = JWTAuth::setToken($token)->toUser();
            $request->merge(['auth_user' => $user]);
        } catch (\Exception $e) {
            return redirect()->route('show-login')->with('error', 'Unauthorized. Please login again.');
        }

        return $next($request);
    }
}
