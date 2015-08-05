<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReservationNights extends Migration
{

    public function up()
    {
        Schema::create('reservation_nights', function ($table) {
            $table->increments('id');
            $table->float('rate');
            $table->date('day');
            $table->integer('room_type_id');
            $table->integer('reservation_id');
            $table->date('created_at');
            $table->date('updated_at');
        });
    }


    public function down()
    {
        Schema::drop('reservation_nights');
    }
}
