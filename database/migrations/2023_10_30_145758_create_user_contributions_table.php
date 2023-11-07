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
        Schema::create('user_contributions', function (Blueprint $table) {
            $table->comment('This table represent contributions made by a user');
            $table->id();
            $table->string('user_id');
            $table->decimal('amount', 13, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('mainone_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_contributions');
    }
};
