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
        Schema::create('exam_structures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('examID');
            $table->json('examStructure');
            $table->timestamps();

            $table->foreign('examID')->references('id')
            ->on('exams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_structures');
    }
};
