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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('assignmentName');
            $table->string('assignmentDescription');
            $table->dateTime('dueDate');
            $table->dateTime('openDate');
            $table->binary('files');
            $table->unsignedBigInteger('courseID');

            $table->foreign('courseID')->constrained('assignments_courseID')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
