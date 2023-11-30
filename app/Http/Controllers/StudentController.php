<?php

namespace App\Http\Controllers;

use App\Models\students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index']);
    }

    private function validateStudent(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'gender' => 'required|in:Male,Female',
            'major' => 'required|string|max:255',
        ];

        return Validator::make($request->all(), $rules);
    }

    public function index()
    {
        try {
            $student = students::all();

            if (!$student) {
                return response()->json(['error' => 'Student not found'], 404);
            }
            return response()->json([
                'status' => true,
                'message' => 'Students data found',
                'students' => $student
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $student = students::find($id);

            if (!$student) {
                return response()->json(['error' => 'Student not found'], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Student data found',
                'student' => $student
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = $this->validateStudent($request);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $student = students::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Student created successfully',
                'student' => $student
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create student: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validateStudent($request);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $student = students::find($id);

            if (!$student) {
                return response()->json(['error' => 'Student not found'], 404);
            }

            $student->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Student updated successfully',
                'student' => $student
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update student: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $student = students::find($id);

            if (!$student) {
                return response()->json(['error' => 'Student not found'], 404);
            }

            $student->delete();

            return response()->json([
                'status' => true,
                'message' => 'Student deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete student: ' . $e->getMessage()], 500);
        }
    }
}
