<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
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
                session(['access_token' => $data['access_token']]);
                return redirect('/'); 
            } else {
                return redirect()->route('show-login')->with('error', 'Invalid email or password. Please try again.');
            }
        } catch (\Exception $e) {
            return redirect()->route('show-login')->with('error', 'Invalid response from server.');
        }
    }
    
}
