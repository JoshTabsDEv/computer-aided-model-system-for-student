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
        Schema::table('questions', function (Blueprint $table) {
            //
             $table->unsignedBigInteger('classwork_id')->nullable()->after('text');

            $table->foreign('classwork_id')->references('id')->on('course_content_classwork')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            //
              $table->dropForeign(['classwork_id']);

            // Then drop the column
            $table->dropColumn('classwork_id');
        });
    }
};
