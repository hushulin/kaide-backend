<?php namespace Hushulin\Kaide\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateNotificationsTable extends Migration
{

    public function up()
    {
        Schema::create('hushulin_kaide_notifications', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hushulin_kaide_notifications');
    }

}
