<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('fullname', 50)->nullable();
            $table->string('email');
            $table->string('phone_number', 11)->nullable();
            $table->boolean('is_locked')->default(false);
            $table->timestamp('last_change_password_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();

            $table->unique(['username', 'email', 'phone_number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
