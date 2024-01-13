<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('courseName');
            $table->string('courseDescription');
            $table->binary('courseImg');
            $table->unsignedBigInteger('speciality');
            $table->unsignedBigInteger('semester');
            $table->unsignedBigInteger('teacherID');


            $table->foreign('speciality')->references('id')
            ->on('specialities')->onDelete('cascade');
            $table->foreign('semester')->references('id')
            ->on('semesters')->onDelete('cascade');
            $table->foreign('teacherID')->references('id')
            ->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
