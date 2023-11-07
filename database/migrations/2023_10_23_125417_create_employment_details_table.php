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
        Schema::create('employment_details', function (Blueprint $table) {
            $table->string('mainone_id', 20)->primary();
            $table->string('department', 100);
            $table->date('resumption_date');
            $table->string('job_title', 100);
            $table->tinyInteger('is_permanent_staff');
            $table->timestamps();
            $table->foreign('mainone_id')->references('mainone_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_details');
    }
};
