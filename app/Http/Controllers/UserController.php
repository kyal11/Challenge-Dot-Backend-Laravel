<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Get all users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $users = User::all();
            
            return response()->json([
                'status'=>true,
                'message' => 'Users data found',
                'users' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving users: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Register a new user.
     *
     * 
     * @param \App\Http\Controllers\AuthController $authController
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, AuthController $authController)
    {
        try {
            return $authController->register($request);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error registering user: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified user.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,$id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $rules = [
                'name' => 'string', 
                'email' => 'email|unique:users,email,' . $user->id,
                'password' => 'min:6',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            if ($request->has('name')) {
                $user->name = $request->input('name');
            }

            if ($request->has('email')) {
                $user->email = $request->input('email');
            }

            if ($request->has('password')) {
                $user->password = bcrypt($request->input('password'));
            }

            $user->save();
            return response()->json(['message' => 'User updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating user: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request,$id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $user->delete();

            return response()->json(['message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting user: ' . $e->getMessage()], 500);
        }
    }
    /**
     * Get authenticated user.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    // public function AuthUser(Request $request)
    // {
    //     $token = $request->header('Authorization');

    //     if ($token === null) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     try {
    //         $user = auth()->user();
            
    //         if (!$user) {
    //             return response()->json(['error' => 'Unauthorized'], 401);
    //         }

    //         return $user;
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }
    // }
}
