<?php

use App\Http\Controllers\web\CourseController;
use App\Http\Controllers\web\GradeController;
use App\Http\Controllers\web\LoginController;
use App\Http\Controllers\web\RegisterController;
use App\Http\Controllers\web\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
});

Route::get('login', [LoginController::class,'showLoginForm'])->name('show-login');
Route::post('login',[LoginController::class,'login'])->name('login');

Route::get('register',[RegisterController::class,'showRegisterForm'])->name('show-register');
Route::post('register',[RegisterController::class,'register'])->name('register');



 Route::get('/dashboard', function () {
        return view('welcome');
})->name('dashboard');

Route::get('/students', [StudentController::class, 'show'])->name('show-student');
Route::post('/students', [StudentController::class, 'create'])->name('create-student');
Route::get('/students/{id}', [StudentController::class, 'edit'])->name('edit-student');
Route::put('/students/{id}', [StudentController::class, 'update'])->name('update-student');
Route::delete('/students/{id}', [StudentController::class, 'delete'])->name('delete-student');

Route::get('/courses', [CourseController::class, 'show'])->name('show-course');
Route::get('/grades', [GradeController::class, 'show'])->name('show-grade');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

