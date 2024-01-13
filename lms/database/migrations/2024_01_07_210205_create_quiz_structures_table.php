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
        Schema::create('quiz_structures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->json('quizStructure');
            $table->unsignedBigInteger('quizID');

            $table->foreign('quizID')->references('id')->on('quizzes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_structures');
    }
};
