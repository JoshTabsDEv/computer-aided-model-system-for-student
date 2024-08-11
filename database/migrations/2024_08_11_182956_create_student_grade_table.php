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
        Schema::create('student_grade', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('score');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('classwork_id');

            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->foreign('classwork_id')->references('id')->on('course_content_classwork')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_grade');
    }
};
