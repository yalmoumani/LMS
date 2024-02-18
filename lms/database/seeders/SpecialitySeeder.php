<?php

namespace Database\Seeders;

use App\Models\Speciality;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run()
    {
        $majorNames = [
            "Computer Science",
            "Electrical Engineering",
            "Mechanical Engineering",
            "Business Administration",
            "Psychology",
            // Add more major names as needed
        ];

        foreach ($majorNames as $majorName) {
            Speciality::create([
                "specialityName" => $majorName,
            ]);
        }
    }

}
