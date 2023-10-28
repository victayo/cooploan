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
        Schema::create('loan_guarantors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_id');
            $table->string('user_id');
            $table->string('guarantor_id');
            $table->decimal('amount');
            $table->string('status')->default('pending');
            $table->timestamp('date_approved')->nullable();

            $table->foreign('guarantor_id')->references('mainone_id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('mainone_id')->on('users')->onDelete('cascade');
            $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_guarantors');
    }
};
