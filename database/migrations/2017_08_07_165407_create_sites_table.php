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
            $table->text('site_image_1')->nullable();
            $table->text('site_image_2')->nullable();
            $table->integer('site_qlt_1')->nullable();
            $table->integer('site_qlt_2')->nullable();
            $table->text('ads')->nullable();
            $table->integer('ads_time')->default(0);
            $table->integer('ads_qlt_2')->nullable();
            $table->text('required_field');
            $table->integer('status');
            $table->integer('step')->default(0);
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
