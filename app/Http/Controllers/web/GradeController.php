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
            return redirect()->route('show-grade')->withErrors($e->getMessage())->withInput();
        }
    }
    public function create(Request $request) {
        try {
            $response = Http::post(self::API_URL, $request->all());
            $data = $response->json();
            if (!isset($data['status'])) {
                return redirect()->route('show-grade')->withErrors($data['error'])->withInput();
            } else {
                return redirect()->route('show-grade')->with('success', 'Successfully Updated Data Grade');
            }
        } catch (\Exception $e) {
            return redirect()->route('show-grade')->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $response = Http::get(self::API_URL . "/$id", $request->all() );
            if ($response->successful()) {
                $data = $response->json();
                $grades = collect([$data['grade']])->map(function ($grade) {
                    $grade['student_name'] = students::find($grade['student_id'])->name;
                    $grade['course_name'] = courses::find($grade['course_id'])->name;
                    return $grade;
                });
                return view('pages.grades', ['data' => $grades]);
            }
        } catch (\Exception $e) {
            return redirect()->route('show-grade')->withErrors($e->getMessage())->withInput();
        }
    }
    

    public function update(Request $request, $id)
    {
        try {
            $response = Http::put(self::API_URL . "/$id", $request->all());
            $data = $response->json();

            if (!isset($data['status'])) {
                return redirect()->route('show-grade')->withErrors($data['error'])->withInput();
            } else {
                return redirect()->route('show-grade')->with('success', 'Successfully Updated Data Grade');
            }
        } catch (\Exception $e) {
            return redirect()->route('show-grade')->withErrors($e->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
        try {
            $response = Http::delete(self::API_URL . "/$id");
            $data = $response->json();

            if (!isset($data['status'])) {
                return redirect()->route('show-grade')->withErrors($data['error'])->withInput();
            } else {
                return redirect()->route('show-grade')->with('success', 'Successfully Delete Data Grade');
            }
        } catch (\Exception $e) {
            return redirect()->route('show-grade')->withErrors($e->getMessage())->withInput();
        }
    }
}
