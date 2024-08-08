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
        Schema::table('student_classwork', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('sub_classwork_id')->nullable()->after('classwork_id');

            $table->foreign('sub_classwork_id')->references('id')->on('sub_classwork_content')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_classwork', function (Blueprint $table) {
            //
             $table->dropForeign(['sub_classwork_id']);

            // Then drop the column
            $table->dropColumn('sub_classwork_id');
        });
    }
};
