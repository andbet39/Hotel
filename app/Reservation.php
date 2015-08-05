<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['total_price', 'occupancy','checkin','checkout','name'];

    public function nights()
    {
        return $this->hasMany('App\ReservationNight');
    }

    function Customer(){
        return $this->belongsTo('App\Customer');
    }
}
