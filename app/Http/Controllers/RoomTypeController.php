<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\RoomType;

class RoomTypeController extends Controller
{


    public function index()
    {
        $room_types = RoomType::all();
        return $room_types;
    }

    public function store(Request $request)
    {
        $room_type=new RoomType($request->all());
        $room_type->save();

        return $room_type;
    }
}
