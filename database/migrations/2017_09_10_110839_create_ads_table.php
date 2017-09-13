s<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads',function(Blueprint $table){
            $table->increments('ads_id');
            $table->integer('user_id');
            $table->integer('template_id');
            $table->integer('target_gender');
            $table->string('target_age');
            $table->integer('timeout');
            $table->string('photo')->nullable();
            $table->string('video')->nullable();
            $table->integer('type');
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
        Schema::dropIfExists('ads');
    }
}
