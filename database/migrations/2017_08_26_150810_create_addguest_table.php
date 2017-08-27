<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddguestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guests',function(Blueprint $table){
            $table->string('rating_key')->after('status')->nullable();
            $table->string('rating_value')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guests',function(Blueprint $table){
            $table->dropColumn('rating_key');
            $table->dropColumn('rating_value');
        });
    }
}
