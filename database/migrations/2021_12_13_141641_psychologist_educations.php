<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PsychologistEducations extends Migration
{
    public function up()
    {
        Schema::create('psychologist_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('education');
            $table->boolean('primary')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('psychologist_educations');
    }
}
