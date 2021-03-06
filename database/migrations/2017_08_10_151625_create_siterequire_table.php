<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiterequireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_fields', function(Blueprint $table){
            $table->increments('field_id');
            $table->integer('template_id');
            $table->text('social_login')->nullable();
            $table->text('form_login')->nullable();
            $table->text('feedback_fields')->nullable();
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
        Schema::dropIfExists('landing_fields');
    }
}
