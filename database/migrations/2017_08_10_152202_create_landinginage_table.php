<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandinginageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_profiles',function(Blueprint $table){
            $table->increments('profile_id');
            $table->string('header_image')->nullable();
            $table->string('background_image')->nullable();
            $table->string('footer_image')->nullable();
            $table->string('background_color')->nullable();
            $table->integer('site_id');
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
        Schema::dropIfExists('landing_profiles');
    }
}
