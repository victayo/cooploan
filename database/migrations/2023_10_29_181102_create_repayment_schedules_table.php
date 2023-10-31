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
        Schema::create('repayment_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_id');
            $table->date('repayment_date');
            $table->decimal('beginning_balance', 13, 2);
            $table->decimal('interest', 13, 2);
            $table->decimal('principal', 13, 2);
            $table->decimal('end_balance', 13, 2);
            $table->decimal('monthly_repayment', 13, 2);
            $table->string('status')->default('pending')->comment('pending, settled, restructured, invalid (due to restructuring)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repayment_schedules');
    }
};
