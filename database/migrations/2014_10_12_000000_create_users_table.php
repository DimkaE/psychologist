<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->integer('role');
            $table->string('gender')->nullable();
            $table->string('second_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('birthdate')->nullable();
            $table->integer('experience')->nullable();
            $table->integer('experience_online')->nullable();
            $table->integer('clients')->nullable();
            $table->boolean('psychotherapy')->nullable();
            $table->boolean('supervision')->nullable();
            $table->string('supervisor')->nullable();
            $table->string('longest_consultation')->nullable();
            $table->text('about')->nullable();
            $table->text('other_work')->nullable();
            $table->string('skype')->nullable();
            $table->string('discord')->nullable();
            $table->string('hangouts')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('published')->default(false);
            $table->boolean('enabled')->default(true);
            $table->string('bank_name')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('bank_holder')->nullable();
            $table->string('bank_date')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
}
