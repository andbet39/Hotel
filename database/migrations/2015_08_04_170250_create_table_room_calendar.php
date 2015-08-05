<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRoomCalendar extends Migration
{
    public function up()
    {

        Schema::create('room_calendars', function ($table) {
            $table->increments('id');
            $table->integer('room_type_id');
            $table->integer('availability');
            $table->integer('reservations');
            $table->float('rate');
            $table->date('day');
            $table->date('created_at');
            $table->date('updated_at');
        });
    }


    public function down()
    {
        Schema::drop('room_calendars');

    }
}