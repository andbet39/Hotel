<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReservations extends Migration
{

    public function up()
    {
        Schema::create('reservations', function ($table) {
            $table->increments('id');
            $table->float('total_price');
            $table->integer('occupancy');
            $table->date('checkin');
            $table->date('checkout');
            $table->string('customer_id');
            $table->date('created_at');
            $table->date('updated_at');
        });
    }

    public function down()
    {
        Schema::drop('reservations');

    }
}
