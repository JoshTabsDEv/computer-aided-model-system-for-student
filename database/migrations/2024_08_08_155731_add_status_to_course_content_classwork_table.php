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
        Schema::table('course_content_classwork', function (Blueprint $table) {
           $table->enum('status',[1,2])->default(1)->after('deadline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_content_classwork', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
