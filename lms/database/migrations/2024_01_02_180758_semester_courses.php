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
        Schema::create('semester_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('semesterID');
            $table->unsignedBigInteger('courseID');

            $table->foreign('semesterID')->references('id')->on('semesters')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('courseID')->references('id')->on('courses')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semester_courses');
    }
};
