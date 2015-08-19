<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customer;

class PaymentController extends Controller
{

    public function pay(Request $request){

        $token  = $request['token'];
        $cutomer_id  =$request['customer_id'];
        $total_price  =$request['total']*100;

        $customer = Customer::find($cutomer_id);

        if($customer->charge($total_price,
            [
            'source' => $token,
             'receipt_email' => $customer->email
            ]))
        {
            $mess = ['status' => "OK","message" =>"Payment ok"];
            return $mess;
        }else{
            $mess = ['status' => "ERROR","message" =>"Error submitting payment"];
            return $mess;
        }
    }

}
