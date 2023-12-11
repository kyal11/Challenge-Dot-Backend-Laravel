<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
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
                // Set the token as a basic PHP cookie
                setcookie('jwt_token', $data['access_token'], time() + (60 * 24 * 60), '/');

                // Redirect to the dashboard page
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('show-login')->with('error', 'Invalid email or password. Please try again.');
            }
        } catch (\Exception $e) {
            return redirect()->route('show-login')->with('error', 'Invalid response from the server.');
        }
    }

    public function logout(Request $request)
    {
        try {
            $jwtToken = $_COOKIE['jwt_token'] ?? null;

            // Expire the cookie by setting its expiration to a past time
            setcookie('jwt_token', '', time() - 3600, '/');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken, 
            ])->post('http://127.0.0.1:8000/api/auth/logout');

            return redirect()->route('login');
        } catch (\Exception $e) {
            return redirect()->route('show-login')->with('error', 'Error logging out. Please try again.');
        }
    }
}
