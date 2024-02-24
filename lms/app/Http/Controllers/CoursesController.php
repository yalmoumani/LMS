<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{
    public function createCourse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "courseName" => 'required|string',
            "courseDescription" => 'required|string',
            "courseImg" => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => ["", $validator->errors()->all()]], 422);
        }

            Courses::create([
            'courseName' => $request->input('courseName'),
            'courseDescription' => $request->input('courseDescription'),
            'courseImg' => $request->input('courseImg'),
        ]);

        return response()->json(["message" => "Course created successfully"], 200);    }
        public function editCourse(){

        }
        public function deleteCourse($id){
            Courses::findorfail($id, 'id')->delete();
            return response()->json(['message' => 'Course successfully deleted'], 200);
        }
}
