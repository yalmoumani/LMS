<?php

namespace App\Http\Controllers;

use App\Models\Assignments;
use App\Models\AssignmentSubmissions;
use Illuminate\Http\Request;

class AssignmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    //  Creates the assignment and allows for validation along with attaching files
    public function createAssignment(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'assignmentName' => 'required|string',
            'assignmentDescription' => 'required|string',
            'dueDate' => 'required|date_format:Y-m-d H:i:s|after:openDate',
            'openDate' => 'required|date_format:Y-m-d H:i:s',
            'courseID' => 'required|integer',
            'files' => 'nullable|array',
        ]);

        // Set the current timestamp for created_at and updated_at fields
        $validatedData['created_at'] = now();
        $validatedData['updated_at'] = now();

        // Create a new Assignments model instance
        $assignment = new Assignments();

        // Set the assignment properties using the validated data
        $assignment->assignmentName = $validatedData['assignmentName'];
        $assignment->assignmentDescription = $validatedData['assignmentDescription'];
        $assignment->dueDate = $validatedData['dueDate'];
        $assignment->openDate = $validatedData['openDate'];
        $assignment->courseID = $validatedData['courseID'];

        // Save the uploaded files as blobs
        $uploadedFiles = $request->file('files');

        if ($uploadedFiles) {
            $fileBlobs = [];

            foreach ($uploadedFiles as $file) {
                $fileBlob = file_get_contents($file);
                $fileBlobs[] = $fileBlob;
            }

            $assignment->files = $fileBlobs;
        }

        // Save the assignment
        $assignment->save();

        return response()->json(['message' => 'Assignment successfully created'], 200);
    }

    // allows for editing the assignment
    public function editAssignment(Request $request, $id)
    {
        // Find the assignment by ID or throw an exception if not found
        $assignment = Assignments::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'assignmentName' => 'nullable|string',
            'assignmentDescription' => 'nullable|string',
            'dueDate' => 'nullable|date_format:Y-m-d H:i:s',
            'openDate' => 'nullable|date_format:Y-m-d H:i:s|after:startDate',
            'courseID' => 'nullable|integer',
            'files' => 'nullable|array',
        ]);

        $validatedData['updated_at'] = now();

        // Update the assignment properties if they are not empty
        if (!empty($validatedData['assignmentName'])) {
            $assignment->assignmentName = $validatedData['assignmentName'];
        }
        if (!empty($validatedData['assignmentDescription'])) {
            $assignment->assignmentDescription = $validatedData['assignmentDescription'];
        }
        if (!empty($validatedData['dueDate'])) {
            $assignment->dueDate = $validatedData['dueDate'];
        }
        if (!empty($validatedData['openDate'])) {
            $assignment->openDate = $validatedData['openDate'];
        }
        if (!empty($validatedData['courseID'])) {
            $assignment->courseID = $validatedData['courseID'];
        }
        if (!empty($validatedData['files'])) {
            $assignment->files = $validatedData['files'];
        }

        // Save the updated assignment
        $assignment->save();

        return response()->json(['message' => 'Assignment successfully edited'], 200);

    }

    // allows to view certain assignments
    public function showAssignment($id){
      return  Assignments::findorfail($id);
    }
    // shows all the assignments for specific courses
    public function courseAssignments($corId){
      return  Assignments::where('courseID', $corId)->get();
    }
    // deletes the assignments
    public function deleteAssignment($id)
    {
        Assignments::findorfail($id)->delete();

        return response()->json(['message' => 'Assignment successfully deleted'], 200);

    }
    // this is not working idk why but its not
    public function submitAssignment(Request $request)
    {
        $validatedData = $request->validate([
            'userID' => 'required|integer',
            'assignmentID' => 'required|integer',
            'files' => 'required|array',
            'files.*' => 'required|file', // Validate each file in the array
            'grade' => 'nullable|integer',
        ]);

        $submission = new AssignmentSubmissions();

        $submission->userID = $validatedData['userID'];
        $submission->assignmentID = $validatedData['assignmentID'];
        $submission->grade = $validatedData['grade'];

        $uploadedFiles = $request->file('files');

        if ($uploadedFiles) {
            $fileBlobs = [];

            foreach ($uploadedFiles as $file) {
                $fileBlob = file_get_contents($file);
                $fileBlobs[] = $fileBlob;
            }
            $submission->files = $fileBlobs;
        }

        // Save the submission
        $submission->save();

        return response()->json(['message' => 'Assignment submitted successfully'], 200);
    }

    public function editSubmission(){

    }
    public function deleteSubmission(){

    }
    public function deleteItem(){

    }
}

