<?php

namespace App\Http\Controllers;

use App\Models\Exams;
use App\Models\ExamStructure;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    //  add the number of questions
    // creates the basic componenets of the exam without the structural parts of questions, answers, and options
    public function createExam(Request $request){
        $requestData = [
            'examName' => 'required',
            'examDescription' => 'required',
            'created_at' => now(),
            'updated_at' => now(),
            'examType' => 'required|in:Midterm,Final',
            'startDate' => 'required|date',
            'closingDate' => 'required|date',
            'duration' => 'required',
            'courseID' => 'required',
        ];

        $validatedData = $request->validate($requestData);

        $exam = new Exams();

        $exam->examName = $validatedData['examName'];
        $exam->examDescription = $validatedData['examDescription'];
        $exam->created_at = $validatedData['created_at'];
        $exam->updated_at = $validatedData['updated_at'];
        $exam->examType = $validatedData['examType'];
        $exam->startDate = $validatedData['startDate'];
        $exam->closingDate = $validatedData['closingDate'];
        $exam->duration = $validatedData['duration'];
        $exam->courseID = $validatedData['courseID'];

        // Save the exam
        $exam->save();

        // Return success response
        return response()->json(['message' => 'Exam successfully created', 'exam' => $exam], 200);
    }
    // creates the structure of the exam using an array to save the questions and options
    public function examDetails($question, $options, $answer, $examID)
    {
        $examID -> examID;
        $exam = array(
            'question' => $question,
            'options' => array_values($options),
            'answer' => $answer
        );

        $examStructure = new ExamStructure();
        $examStructure->exam = $exam;
        $examStructure->save();

        return $exam;
    }
    public function editExam()
    {
    }
    public function deleteExam($examId)
    {
      ExamStructure::findorfail($examId)->delete();
    }
    public function deleteQuestion($examId, $questionIndex)
{
    $examStructure = ExamStructure::findOrFail($examId);
    $questions = $examStructure->exam['questions'];

    if (isset($questions[$questionIndex])) {
        unset($questions[$questionIndex]);
        $examStructure->exam['questions'] = array_values($questions);
        $examStructure->save();
    }
}

public function deleteOption($examId, $optionIndex)
{
    $examStructure = ExamStructure::findOrFail($examId);
    $options = $examStructure->exam['options'];

    if (isset($options[$optionIndex])) {
        unset($options[$optionIndex]);
        $examStructure->exam['options'] = array_values($options);
        $examStructure->save();
    }
}
}
