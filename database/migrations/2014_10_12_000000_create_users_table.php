<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('mainone_id', 20)->primary();
            $table->string('firstname', 30);
            $table->string('middlename', 30)->nullable();
            $table->string('lastname', 30);
            $table->string('email', 100)->unique();
            $table->string('phone', 50);
            $table->timestamp('email_verified_at')->nullable();
            $table->date('dob');
            $table->string('password');
            $table->string('address');
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('country', 50);
            $table->string('gender', 10);
            $table->string('status', 10)->default('pending');
            $table->decimal('save_amount', 13, 2);
            $table->decimal('membership_fee');
            $table->timestamp('date_approved')->nullable();
            $table->timestamp('date_deactivated')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
