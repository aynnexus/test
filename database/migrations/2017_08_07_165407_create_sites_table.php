<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites',function(Blueprint $table){
            $table->increments('site_id');
            $table->string('site_name',60);
            $table->string('site_location')->nullable();
            $table->integer('data_limit')->default(0);
            $table->integer('time_limit')->default(0);
            $table->integer('timeout_limit')->default(0);
            $table->integer('speed_limit')->default(0);
            $table->integer('status');
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
        Schema::dropIfExists('sites');
    }
}
