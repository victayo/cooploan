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
            $table->string('email', 30)->unique();
            $table->string('phone', 15);
            $table->timestamp('email_verified_at')->nullable();
            $table->date('dob');
            $table->string('password');
            $table->string('address');
            $table->string('city', 15);
            $table->string('state', 15);
            $table->string('country', 15);
            $table->string('gender', 10);
            $table->string('approval_status', 10)->default('pending');
            $table->string('status', 10)->default('active');
            $table->decimal('save_amount');
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
