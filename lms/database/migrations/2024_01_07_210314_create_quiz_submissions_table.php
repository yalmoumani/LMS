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
        Schema::create('quiz_submissions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('quizID');
            $table->json('quizSubmission');
            $table->bigInteger('grade')->nullable();

            $table->foreign('userID')->references('id')
            ->on('users')->onDelete('cascade');
            $table->foreign('quizID')->references('id')
            ->on('quizzes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_submissions');
    }
};
