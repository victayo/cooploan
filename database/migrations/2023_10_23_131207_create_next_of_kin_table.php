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
        Schema::create('next_of_kin', function (Blueprint $table) {
            $table->id();
            $table->string('mainone_id', 20);
            $table->string('firstname', 30);
            $table->string('lastname', 30);
            $table->date('dob');
            $table->string('email', 100);
            $table->string('address');
            $table->string('phone', 50);
            $table->timestamps();

            $table->foreign('mainone_id')->references('mainone_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('next_of_kin');
    }
};
