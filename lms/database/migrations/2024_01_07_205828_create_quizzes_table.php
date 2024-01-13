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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('quizName');
            $table->string('quizDescription');
            $table->dateTime('openTime');
            $table->dateTime('closingTime');
            $table->integer('duration');
            $table->unsignedBigInteger('courseID');

            $table->foreign('courseID')->references('id')
            ->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
