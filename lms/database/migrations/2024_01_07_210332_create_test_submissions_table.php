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
        Schema::create('test_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('testID');
            $table->unsignedBigInteger('userID');
            $table->json('testResponse');
            $table->timestamps();

            $table->foreign('testID')->references('id')
            ->on('tests')->onDelete('cascade');
            $table->foreign('userID')->references('id')
            ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_submissions');
    }
};
