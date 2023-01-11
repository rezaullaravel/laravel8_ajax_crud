<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

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

Route::get('/',[StudentController::class,'index']);
Route::post('/store/student',[StudentController::class,'storeStudent']);
Route::get('/edit/student/{id}',[StudentController::class,'editStudent']);
Route::post('/student/update/{id}',[StudentController::class,'updateStudent']);
Route::get('/student/delete/{id}',[StudentController::class,'deleteStudent']);


Route::get('/teacher/ajax',[TeacherController::class,'index']);
Route::post('/store/teacher',[TeacherController::class,'store']);
Route::get('/edit/teacher/{id}',[TeacherController::class,'edit']);
Route::post('/update/teacher/{id}',[TeacherController::class,'update']);
Route::get('/delete/teacher/{id}',[TeacherController::class,'delete']);
