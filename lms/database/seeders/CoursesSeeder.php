<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Courses;
use Carbon\Carbon;


class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'courseName' => 'Course 1',
                'courseDescription' => 'Description for Course 1',
                'courseImg' => 'path/to/course1-image.jpg',
                'speciality' => 'Speciality 1',
                'semester' => rand(1, 3),
                'teacherID' => 1,
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'courseName' => 'Course 2',
                'courseDescription' => 'Description for Course 2',
                'courseImg' => 'path/to/course2-image.jpg',
                'speciality' => 'Speciality 2',
                'semester' => rand(1, 3),
                'teacherID' => 1,
            ],
            // Add more courses as needed
        ];

        foreach ($courses as $courseData) {
            Courses::create($courseData);
        }
    }
}
