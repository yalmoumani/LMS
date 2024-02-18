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
    public function createExam($question, $options, $answer)
    {
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
