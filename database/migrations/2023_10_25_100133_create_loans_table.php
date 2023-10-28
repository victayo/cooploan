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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->decimal('loan_amount');
            $table->integer('tenure');
            $table->decimal('interest');
            $table->decimal('monthly_deduction');
            $table->string('status')->default('pending');
            $table->timestamp('date_approved');
            $table->timestamps();

            $table->foreign('user_id')->references('mainone_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
