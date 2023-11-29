<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', function () {
    return response()->json([
        'status' => false,
        'message' => 'Token tidak valid'
    ], 401);
})->name('login');
Route::post('register',[AuthController::class, 'register'])->name('register');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {

    Route::post('login',[AuthController::class, 'login'])->name('login');
    Route::post('logout',[AuthController::class, 'logout'])->name('logout');
    Route::post('account',[AuthController::class, 'account'])->name('account');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'users'
], function () {
    Route::get('/', [UserController::class, 'index'])->name('get-all-user');
    Route::post('/', [UserController::class, 'store'])->name('add-user');
    Route::patch('/{id}', [UserController::class, 'update'])->name('update-user');
    Route::delete('/{id}', [UserController::class, 'delete'])->name('delete-user');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'courses'
], function () {
    Route::get('/', [CourseController::class, 'index'])->name('get-all-course');
    Route::get('/{id}', [CourseController::class, 'show'])->name('get-detail-corse');
    Route::post('/', [CourseController::class, 'store'])->name('create-course');
    Route::put('/{id}', [CourseController::class, 'update'])->name('update-course');
    Route::delete('/{id}', [CourseController::class, 'destroy'])->name('delete-course');
});
