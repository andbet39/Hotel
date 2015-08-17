<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reservation;
use App\RoomCalendar;
use App\ReservationNight;
use App\Customer;
use Carbon\Carbon;

class ReservationController extends Controller
{

    public function show($id){
        Reservation::find($id);

        return  Reservation::find($id);

    }

    public function createReservation(Request $request){

        $room_info  =$request['room_info'];

        $start_dt =Carbon::createFromFormat('d-m-Y', $request['start_dt'])->toDateString();
        $end_dt= Carbon::createFromFormat('d-m-Y', $request['end_dt'])->toDateString();

        $customer = Customer::firstOrCreate($request['customer']);

        $reservation  = Reservation::create();
        $reservation->total_price=$room_info['total_price'];
        $reservation->occupancy=$request['occupancy'];
        $reservation->customer_id=$customer->id;
        $reservation->checkin=$start_dt;
        $reservation->checkout=$end_dt;

        $reservation->save();


        $date=$start_dt;

        while (strtotime($date) < strtotime($end_dt)) {

            $room_calendar = RoomCalendar::where('day','=',$date)
                ->where('room_type_id','=',$room_info['id'])->first();

            $night =  ReservationNight::create();
            $night->day=$date;

            $night->rate=$room_calendar->rate;
            $night->room_type_id=$room_info['id'];
            $night->reservation_id=$reservation->id;

            $room_calendar->availability--;
            $room_calendar->reservations++;

            $room_calendar->save();
            $night->save();

            $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));



        }

        $nights = $reservation->nights;
        $customer = $reservation->customer;


        return $reservation;

    }
}
