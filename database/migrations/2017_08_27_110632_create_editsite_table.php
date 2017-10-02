<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditsiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sites',function(Blueprint $table){
            $table->string('site_code')->after('site_name');
            $table->dropColumn('site_location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sites',function(Blueprint $table){
            $table->dropColumn('site_code')->after('site_name');
            $table->dropColumn('site_location');
        });
    }
}
