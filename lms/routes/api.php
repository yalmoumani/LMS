<?php

use App\Http\Controllers\AdminstratorController;
use App\Http\Controllers\ExamsController;
use App\Http\Controllers\CoursesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Routes for adminstrator
Route::post('/admin/createUser', [AdminstratorController::class, 'createUser']);
Route::delete('/admin/{userId}', [AdminstratorController::class, 'deleteUser']);
Route::put('/admin/{userId}', [AdminstratorController::class, 'editUser']);
Route::get('/admin', [AdminstratorController::class, 'getAll']);

Route::post('/courses/createCourse', [CoursesController::class, 'createCourse']);


    Route::post('exams', [ExamsController::class, 'createExam']); // Create a new exam
    // Route::put('exams/{id}', 'ExamsController@editExam'); // Edit an existing exam
    // Route::delete('exams/{id}', 'ExamsController@deleteExam'); // Delete an exam
    // Route::delete('exams/{id}/questions/{questionIndex}', 'ExamsController@deleteQuestion'); // Delete a question
    // Route::delete('exams/{id}/options/{optionIndex}', 'ExamsController@deleteOption'); // Delete an option
