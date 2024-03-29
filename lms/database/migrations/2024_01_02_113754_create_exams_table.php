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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('examName');
            $table->string('examDescription');
            $table->timestamps();
            $table->enum('examType', ['Midterm', 'Final']);
            $table->dateTime('startDate');
            $table->dateTime('closingDate');
            $table->integer('duration');
            $table->unsignedBigInteger('courseID');

            $table->foreign('courseID')->constrained('exams_courseID')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
