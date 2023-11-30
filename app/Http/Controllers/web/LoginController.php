<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    
    public function showLoginForm() {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $API_URL_LOGIN = "http://127.0.0.1:8000/api/auth/login";
    
        try {
            
            $response = Http::post($API_URL_LOGIN, [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);
            $data = $response->json();
    
            if (isset($data['access_token'])) {
                $tokenScript = '<script>localStorage.setItem("jwt_token", "' . $data['access_token'] . '");</script>';

                $redirectScript = '<script>window.location.href = "' . route('dashboard') . '";</script>';

            return $tokenScript . $redirectScript;
            } else {
                return redirect()->route('show-login')->with('error', 'Invalid email or password. Please try again.');
            }
        } catch (\Exception $e) {
            return redirect()->route('show-login')->with('error', 'Invalid response from server.');
        }
    }
    
    public function logout(Request $request)
{
    $jwtToken = $request->cookie('jwt_token');

    try {
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $jwtToken])->post('http://127.0.0.1:8000/api/auth/logout');

        // Add a script to remove the token from local storage
        $removeTokenScript = '<script>localStorage.removeItem("jwt_token");</script>';
        $redirectScript = '<script>window.location.href = "' . route('login') . '";</script>';
        return $removeTokenScript . $redirectScript;
    } catch (\Exception $e) {
        return redirect()->route('show-login')->with('error', 'Error logging out. Please try again.');
    }
}

}
