<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\courses;
use App\Models\students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GradeController extends Controller
{
    const API_URL = "http://127.0.0.1:8000/api/grades";

    public function show()
    {
        try {
            $response = Http::get(self::API_URL);
            if ($response->successful()) {
                $data = $response->json();
                $grades = collect($data['grades'])->map(function ($grade) {
                    $grade['student_name'] = students::find($grade['student_id'])->name;
                    $grade['course_name'] = courses::find($grade['course_id'])->name;
                    return $grade;
                });
    
                return view('pages.grades', ['data' => $grades]);
            } else {
                return view('pages.grades')->with('error', 'Failed to retrieve data from the API.');
            }
        } catch (\Exception $e) {
            return view('pages.grades')->with('error', 'An error occurred while processing the request.');
        }
    }
}
