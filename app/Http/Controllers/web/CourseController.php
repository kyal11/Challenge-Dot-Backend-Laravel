<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CourseController extends Controller
{
    const API_URL = "http://127.0.0.1:8000/api/courses";

    public function show()
    {
        try {
            $response = Http::get(self::API_URL);
            if ($response->successful()) {
                $data = $response->json();
                return view('pages.courses', ['data' => $data['courses']]);
            } else {
                return view('pages.courses')->with('error', 'Failed to retrieve data from the API.');
            }
        } catch (\Exception $e) {
            return view('pages.courses')->with('error', 'An error occurred while processing the request.');
        }
    }
}