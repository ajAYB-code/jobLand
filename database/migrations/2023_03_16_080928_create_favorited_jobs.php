<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFavoritedJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('favorited_jobs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('userId', false);
            $table->unsignedBigInteger('jobId', false);
            $table->timestamps();
        });
        
        Schema::table('favorited_jobs', function (Blueprint $table) {
            $table->foreign('jobId')->references('id')->on('job')->cascadeOnDelete();
            $table->foreign('userId')->references('id')->on('users')->cascadeOnDelete();
            $table->primary(['userId', 'jobId']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorited_jobs');
    }
}
