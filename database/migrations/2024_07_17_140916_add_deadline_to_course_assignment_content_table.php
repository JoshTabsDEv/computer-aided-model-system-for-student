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
        Schema::table('course_assignments_content', function (Blueprint $table) {
            //
            $table->timestamp('deadline')->nullable()->after('classwork_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_assignments_content', function (Blueprint $table) {
            //
            $table->dropColumn('deadline');
        });
    }
};
