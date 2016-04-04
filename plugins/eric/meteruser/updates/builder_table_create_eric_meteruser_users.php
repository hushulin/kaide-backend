<?php namespace Eric\MeterUser\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateEricMeteruserUsers extends Migration
{
    public function up()
    {
        Schema::create('eric_meteruser_users', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('eric_meteruser_users');
    }
}