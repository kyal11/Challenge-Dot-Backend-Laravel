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
            // Retrieve the JWT token from local storage
            $token = $this->getJwtTokenFromLocalStorage();
       
            if (!$token) {
                return redirect()->route('show-login')->with('error', 'Unauthorized. Please login again.');
            }

            return $next($request);
        } catch (\Exception $e) {
            return redirect()->route('show-login')->with('error', 'Unauthorized. Please login again.');
        }

    }

    /**
     * Retrieve the JWT token from local storage using JavaScript
     *
     * @return string|null
     */
    private function getJwtTokenFromLocalStorage()
    {
        // Use JavaScript to get the token from local storage
        $script = <<<SCRIPT
        <script>
            var token = localStorage.getItem('jwt_token');
            document.cookie = 'jwt_token=' + token + '; path=/;';
        </script>
SCRIPT;

        // Execute the JavaScript using Laravel's Blade directive
        return app('blade.compiler')->compileString($script);
    }
}
