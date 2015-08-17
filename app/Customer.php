<?php

namespace App;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Contracts\Billable as BillableContract;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model implements BillableContract
{
    use Billable;

    protected $fillable = ['first_name', 'last_name','email'];

}