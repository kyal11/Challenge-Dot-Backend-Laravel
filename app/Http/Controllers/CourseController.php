<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseValidator;
use App\Models\courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    private function validateCourse(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'credit' => 'required|integer',
            'description' => 'nullable|string',
        ]);
    }

    public function index()
    {
        try {
            $courses = courses::all();

            return response()->json([
                'status' => true,
                'message' => 'Course data found',
                'courses' => $courses
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $course = courses::find($id);

            if (!$course) {
                return response()->json(['error' => 'Course not found'], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Course data found',
                'course' => $course
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = $this->validateCourse($request);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $course = courses::create([
                'name' => $request->input('name'),
                'credit' => $request->input('credit'),
                'description' => $request->input('description'),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Course created successfully',
                'course' => $course
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create course: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validateCourse($request);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        try {
            $course = courses::find($id);
    
            if (!$course) {
                return response()->json(['error' => 'Course not found'], 404);
            }

            $course->update([
                'name' => $request->input('name'),
                'credit' => $request->input('credit'),
                'description' => $request->input('description'),
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Course updated successfully',
                'course' => $course
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update course: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $course = courses::find($id);

            if (!$course) {
                return response()->json(['error' => 'Course not found'], 404);
            }

            $course->delete();

            return response()->json([
                'status' => true,
                'message' => 'Course deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete course: ' . $e->getMessage()], 500);
        }
    }
}
