<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\BookingList;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    //
    public function addBuyerAddress(Request $request)
    { {

            $request->validate([]);


            if ($request->id) {

                $sale = Sale::find($request->id);
            } else

                $sale = new Sale;
            $sale->user_id = Auth::user()->id;
            $sale->vehicle_id = $request->vehicle_id;
            $sale->enq_id = $request->enq_id;
            $sale->sale_price = $request->sale_price;


            if ($request->hasFile('address_proof')) {

                $img_ext = $request->file('address_proof')->getClientOriginalExtension();

                $size = $request->file('address_proof')->getSize();



                $filename = $request->customer_name.'-address_proof-'  . time() . '.' . $img_ext;
                $path = $request->file('address_proof')->move(public_path('uploads/buyerDocuments'), $filename); //image save public folder / uploads/category_upload
                $sale->address_proof = $filename;
            }

            if ($request->hasFile('sale_letter')) {

                $img_ext = $request->file('sale_letter')->getClientOriginalExtension();

                $size = $request->file('sale_letter')->getSize();



                $filename = $request->customer_name.'-sale_letter-'  . time() . '.' . $img_ext;
                $path = $request->file('sale_letter')->move(public_path('uploads/buyerDocuments'), $filename); //image save public folder / uploads/category_upload
                $sale->sale_letter = $filename;
            }

            $booking_list = BookingList::where('enq_id', '=', $request->enq_id)->first();
            $booking_list->sale_status=1;
            $booking_list->save();

            $purchase = Purchase::find($request->vehicle_id);
            $purchase->sale_status=2;
            $purchase->save();


            $sale->save();
            return 'success';
        }
    }
}
