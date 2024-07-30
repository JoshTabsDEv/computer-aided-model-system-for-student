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
        Schema::create('solutions', function (Blueprint $table) {
            $table->id();
            $table->string('solution_file');
            $table->unsignedBigInteger('course_assignment_id');
            $table->unsignedBigInteger('classwork_id');
            $table->timestamps();

            $table->foreign('classwork_id')->references('id')->on('course_content_classwork')->onDelete('cascade');
            $table->foreign('course_assignment_id')->references('id')->on('course_assignments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solutions');
    }
};
