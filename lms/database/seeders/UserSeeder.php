<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $roles = [1, 2, 3, 4];

        foreach ($roles as $role) {
            User::create([
                "name" => $faker->name,
                "mobile" => '075' . $faker->randomNumber(7),
                "emergencyContact" => '077' . $faker->randomNumber(7),
                "dob" => $faker->date,
                "email" => $faker->email,
                "password" => Hash::make("password"),
                "userImg" => "default.jpg",
            ]);

            DB::table('roles_users')->insert([
                'roleID' => $role,
                'userID' => User::latest()->first()->id,
            ]);
        }
    }
}
