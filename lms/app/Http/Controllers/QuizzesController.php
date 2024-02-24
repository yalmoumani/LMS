<?php

namespace App\Http\Controllers;

use App\Models\Quizzes;
use Illuminate\Http\Request;

class QuizzesController extends Controller
{
   public function createQuizzes(request $request){
// Validate the request data
$validatedData = $request->validate([
    'quizName' => 'required|string',
    'quizDescription' => 'required|string',
    'dueDate' => 'required|date_format:Y-m-d H:i:s|after:openDate',
    'openDate' => 'required|date_format:Y-m-d H:i:s',
    'duration' => 'required|integer',
]);

// Set the current timestamp for created_at and updated_at fields
$validatedData['created_at'] = now();
$validatedData['updated_at'] = now();

// Create a new quizs model instance
$quiz = new Quizzes();

// Set the quiz properties using the validated data
$quiz->quizName = $validatedData['quizName'];
$quiz->quizDescription = $validatedData['quizDescription'];
$quiz->dueDate = $validatedData['dueDate'];
$quiz->openDate = $validatedData['openDate'];
$quiz->duration = $validatedData['duration'];

// Save the quiz
$quiz->save();

return response()->json(['message' => 'quiz successfully created'], 200);
}
   public function quizzesStructure(){

   }
   public function editQuizzes(){

   }
   public function deleteQuizzes($id){
   Quizzes::findorfail($id)->delete();

   return response()->json(['message' => 'Quiz successfully deleted'], 200);
   }
}
