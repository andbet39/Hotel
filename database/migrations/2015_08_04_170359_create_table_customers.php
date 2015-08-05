<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCustomers extends Migration
{

    public function up()
    {
        Schema::create('customers', function ($table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->date('created_at');
            $table->date('updated_at');
        });
    }

    public function down()
    {
        Schema::drop('customers');

    }
}
