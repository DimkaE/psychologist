<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consultation_id')->nullable()->constrained();
            $table->foreignId('user_id')->constrained();
            $table->integer('status');
            $table->integer('sum');
            $table->integer('final_sum'); //цена с учетом скидок
            $table->integer('system')->nullable(); //платежная система
            $table->string('ext_id')->nullable(); //идентификатор из платежной системы
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
