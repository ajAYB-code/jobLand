<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId', false);
            $table->string('title', 255);
            $table->string('location', 128);
            $table->string('companyName', 128);
            $table->string('companyEmail', 255);
            $table->string('employmentType', 20);
            $table->text('jobDescription');
            $table->integer('salary', false);
            $table->string('companyLogoImagePath', 150);
            $table->string('tags', 150);
            $table->timestamps();
        });

        Schema::table('job', function (Blueprint $table){
            $table->foreign('userId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job');
    }
}
