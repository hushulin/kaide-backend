<?php namespace Hushulin\Kaide\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateXiaofeisTable extends Migration
{

    public function up()
    {
        Schema::create('hushulin_kaide_xiaofeis', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hushulin_kaide_xiaofeis');
    }

}
