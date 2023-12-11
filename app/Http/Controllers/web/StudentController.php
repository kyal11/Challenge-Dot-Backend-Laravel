<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
{
    const API_URL = "http://127.0.0.1:8000/api/students";

    public function show(Request $request)
    {
        try {
            $jwtToken = $_COOKIE['jwt_token'] ?? null;
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->get(self::API_URL);

            if ($response->successful()) {
                $data = $response->json();
                return view('pages.students', ['data' => $data['students']]);
            } else {
                return view('pages.students')->with('error', 'Failed to retrieve data from the API.');
            }
        } catch (\Exception $e) {
            return view('pages.students')->with('error', 'An error occurred while processing the request.');
        }
    }

    public function create(Request $request)
    {
        try {
            $jwtToken = $_COOKIE['jwt_token'] ?? null;
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->post(self::API_URL, $request->all());

            $data = $response->json();

            if (!isset($data['status'])) {
                return redirect()->route('show-student')->withErrors($data['error'])->withInput();
            } else {
                return redirect()->route('show-student')->with('success', 'Successfully Added Data Student');
            }
        } catch (\Exception $e) {
            return redirect()->route('show-student')->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit(Request $request, $id) {
        $jwtToken = $_COOKIE['jwt_token'] ?? null;
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $jwtToken,
        ])->get(self::API_URL . "/$id", $request->all());

        $data = $response->json();
        return view('pages.students', ['data' => $data['student']]);
    }

    public function update(Request $request, $id)
    {
        try {
            $jwtToken = $_COOKIE['jwt_token'] ?? null;
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->put(self::API_URL . "/$id", $request->all());

            $data = $response->json();

            if (!isset($data['status'])) {
                return redirect()->route('show-student')->withErrors($data['error'])->withInput();
            } else {
                return redirect()->route('show-student')->with('success', 'Successfully Updated Data Student');
            }
        } catch (\Exception $e) {
            return redirect()->route('show-student')->withErrors($e->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
        try {
            $jwtToken = $_COOKIE['jwt_token'] ?? null;
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])->delete(self::API_URL . "/$id");

            $data = $response->json();

            if (!isset($data['status'])) {
                return redirect()->route('show-student')->withErrors($data['error'])->withInput();
            } else {
                return redirect()->route('show-student')->with('success', 'Successfully Delete Data Student');
            }
        } catch (\Exception $e) {
            return redirect()->route('show-student')->withErrors($e->getMessage())->withInput();
        }
    }
}
