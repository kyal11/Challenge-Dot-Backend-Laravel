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

    public function create(Request $request)
    {
        try {
            $response = Http::post(self::API_URL, $request->all());
            $data = $response->json();

            if (!isset($data['status'])) {
                return redirect()->route('show-course')->withErrors($data['error'])->withInput();
            } else {
                return redirect()->route('show-course')->with('success', 'Successfully Added Data Course');
            }
        } catch (\Exception $e) {
            return redirect()->route('show-course')->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit(Request $request, $id) {
        $response = Http::get(self::API_URL . "/$id", $request->all());
        $data = $response->json();
        return view('pages.courses', ['data' => $data['course']]);
    }

    public function update(Request $request, $id)
    {
        try {
            $response = Http::put(self::API_URL . "/$id", $request->all());
            $data = $response->json();

            if (!isset($data['status'])) {
                return redirect()->route('show-course')->withErrors($data['error'])->withInput();
            } else {
                return redirect()->route('show-course')->with('success', 'Successfully Updated Data Course');
            }
        } catch (\Exception $e) {
            return redirect()->route('show-course')->withErrors($e->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
        try {
            $response = Http::delete(self::API_URL . "/$id");
            $data = $response->json();

            if (!isset($data['status'])) {
                return redirect()->route('show-course')->withErrors($data['error'])->withInput();
            } else {
                return redirect()->route('show-course')->with('success', 'Successfully Delete Data Course');
            }
        } catch (\Exception $e) {
            return redirect()->route('show-course')->withErrors($e->getMessage())->withInput();
        }
    }
}