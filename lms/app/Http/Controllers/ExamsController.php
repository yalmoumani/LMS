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
    // needs to be updated so their can only be one midterm and final
    public function createExam(Request $request){
        $requestData = [
            'examName' => 'required',
            'examDescription' => 'required',
            'created_at' => now(),
            'updated_at' => now(),
            'examType' => 'required|in:Midterm,Final',
            'startDate' => 'required|date_format:Y-m-d H:i:s',
                'closingDate' => 'required|date_format:Y-m-d H:i:s|after:startDate',
            'duration' => 'required',
            'courseID' => 'required',
        ];

        $validatedData = $request->validate($requestData);

        $exam = new Exams();

        $exam->examName = $validatedData['examName'];
        $exam->examDescription = $validatedData['examDescription'];
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
    // needs to be corrected to only allow one submission of answers for an exam
    public function examDetails(Request $request)
    {
        $examID = $request->examID;
        $questions = $request->questions;

        $exam = [];

        foreach ($questions as $questionData) {
            $question = $questionData['question'];
            $options = array_values($questionData['options']);
            $answer = $questionData['answer'];

            $exam[] = [
                'question' => $question,
                'options' => $options,
                'answer' => $answer
            ];
        }

        $examStructure = new ExamStructure();
        $examStructure->examID = $examID;
        $examStructure->examStructure = json_encode($exam); // Encode the exam structure as a JSON string
        $examStructure->save();

        return response()->json(['message'=>'Your questions and answers have been saved.'],200);
    }
    public function editExam()
    {
    }

    // Takes the id of the exam and deletes it along with all the questions and gives back response
    public function deleteExam($id)
    {
      Exams::findorfail($id)->delete();
      return response()->json(['message'=>'Exam has been successfully deleted.'],200);
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
