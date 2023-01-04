<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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
