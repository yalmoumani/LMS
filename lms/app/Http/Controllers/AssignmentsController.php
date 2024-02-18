<?php

namespace App\Http\Controllers;

use App\Models\Assignments;
use Illuminate\Http\Request;

class AssignmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function createAssignment(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'assignmentName' => 'required|string',
            'assignmentDescription' => 'required|string',
            'dueDate' => 'required|date_format:Y-m-d H:i:s',
            'openDate' => 'required|date_format:Y-m-d H:i:s|after:startDate',
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

        // Save the assignment
        $assignment->save();

        return response()->json(['message' => 'Assignment successfully created', 'assignment' => $assignment], 200);
    }
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

        // Save the updated assignment
        $assignment->save();

        return response()->json(['message' => 'Assignment successfully edited', 'assignment' => $assignment], 200);
    
    }
    public function deleteAssignment($id)
    {
        Assignments::findorfail($id)->delete();

    }
    public function submitAssignment()
    {
        //
    }
}
