<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
{
    const API_URL = "http://127.0.0.1:8000/api/students";

    public function show()
    {
        try {
            $response = Http::get(self::API_URL);
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
    public function update() {

    }

    public function delete($id) {
        try {
            $response = Http::delete(self::API_URL . "/$id");
            $data = $response->json();

            if ($data['status'] == true) {
                return redirect()->route('show-student')->with('success', 'Successfull Delete Data Student');
            } else {
                $error = $response->json();
                return redirect()->route('show-student')->withErrors($error)->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->route('show-student')->with('error', 'An error occurred while processing the request.');
        }
    }
}
