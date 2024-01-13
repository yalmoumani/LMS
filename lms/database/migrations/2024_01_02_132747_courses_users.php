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
        Schema::create('courses_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('courseID')->unsigned();
            $table->unsignedBiginteger('userID')->unsigned();
            $table->timestamps();

            $table->foreign('courseID')->references('id')
                 ->on('courses')->onDelete('cascade');
            $table->foreign('userID')->references('id')
                ->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
