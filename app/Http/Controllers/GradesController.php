<?php

namespace App\Http\Controllers;

use App\Models\grades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    private function validateGrade(Request $request) {
        return Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'grade' => 'required|string'
        ]);
    }

    public function index(Request $request) {
        try {
            $grades = grades::all();

            return response()->json([
                'status' => true,
                'message' => 'Grade data found',
                'grades' => $grades
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id) {
        try {
            $grade = grades::find($id);

            if (!$grade) {
                return response()->json(['error' => 'Grade not found'], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Grade data found',
                'grade' => $grade
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request) {
        $validator = $this->validateGrade($request);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $grade = grades::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Grade created successfully',
                'grade' => $grade
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create grade: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id) {
        $validator = $this->validateGrade($request);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $grade = grades::find($id);

            if (!$grade) {
                return response()->json(['error' => 'Grade not found'], 404);
            }

            $grade->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Grade updated successfully',
                'grade' => $grade
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update grade: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id) {
        try {
            $grade = grades::find($id);

            if (!$grade) {
                return response()->json(['error' => 'Grade not found'], 404);
            }

            $grade->delete();

            return response()->json([
                'status' => true,
                'message' => 'Grade deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete grade: ' . $e->getMessage()], 500);
        }
    }
}
