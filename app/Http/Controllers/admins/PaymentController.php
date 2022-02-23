<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\BookingList;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    //
    public function addPayment(Request $request)
    {


        $request->validate([
            'pay_date' => 'required',
            'pay_type' => "required",
            'amount' => "required"
        ]);

        if ($request->id) {
            $payment = Payment::find($request->id);
        } else
            $payment = new Payment;

        $payment->user_id = Auth::user()->id;
        $payment->vehicle_id = $request->vehicle_id;
        $payment->enq_id = $request->enq_id;
        $payment->pay_date = $request->pay_date;
        $payment->amount = $request->amount;
        $payment->pay_type = $request->pay_type;

        if($request->remarks)
        $payment->remarks = strtoupper($request->remarks);
        else
        $payment->remarks = "NO REMARKS GIVEN";



        $payment->save();

        $booking_list = BookingList::where('enq_id', '=', $request->enq_id)->first();
        if ($booking_list->total_payment_recieved != null) {
            $booking_list->total_payment_recieved = $booking_list->total_payment_recieved + $request->amount;
        }

        $booking_list->save();
        return 'success';
    }

    public function getHistory(Request $request)
    {
        if ($request->enq_id) {
            $history = Payment::where('enq_id', '=', $request->enq_id)->orderBy('id', 'DESC')->get();
            return $history;
        }
    }
}
