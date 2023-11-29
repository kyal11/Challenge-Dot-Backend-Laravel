<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    
    public function showRegisterForm() {
        return view('auth.Register');
    }

    public function register(Request $request)
    {
        $API_URL_REGISTER = "http://127.0.0.1:8000/api/auth/register";
    
        try {
            $response = Http::post($API_URL_REGISTER, [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);
    
            $data = $response->json();
            if (isset($data['status']) && $data['status'] === true) {
                return redirect()->route('show-register')->with('success', 'Registration successful! Please login.');
            } else {
                return redirect()->route('show-register')->with('error','Registration failed.');
            }
        } catch (\Exception $e) {
            return redirect()->route('show-register')->with('error', 'Error communicating with the server.');
        }
    }
}
