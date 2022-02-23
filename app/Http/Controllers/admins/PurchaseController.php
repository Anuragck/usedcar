<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function addPurchase(Request $request)
    {
        $request->validate([

            "brand_id"  => 'required',
            'reg_no' => "required|unique:purchases,reg_no,$request->id"


        ]);


        if ($request->id) {

            $purchase = Purchase::find($request->id);
        } else

            $purchase = new Purchase;

        $purchase->user_id = Auth::user()->id;
        $purchase->brand_id = $request->brand_id;
        $purchase->model_id = $request->model_id;
        $purchase->color = strtoupper($request->color);
        $purchase->model_id = $request->model_id;
        $purchase->year_of_reg = $request->year_of_reg;


        // //To make register_no clean ie KL-11-A-134 / KL 11 A 134 / KL-11 A 134 becomes KL11A134
        // $register_no = preg_replace('/[^A-Za-z0-9]/', '', strtoupper($request->reg_no));
        $purchase->reg_no = $request->reg_no;



        $purchase->fuel = strtoupper($request->fuel_type);
        $purchase->kms_driven = $request->kms_driven;
        $purchase->no_of_owners = $request->no_of_owners;
        $purchase->cc = $request->cc;
        $purchase->rto = $request->rto;
        $purchase->transmission_type = $request->transmission_type;
        $purchase->gear_box = $request->gear_box;
        $purchase->milage_per_km = $request->milage;
        $purchase->no_of_seats = $request->no_of_seats;
        $purchase->drive_type = $request->drive_type;
        $purchase->front_brake = $request->front_brake;
        $purchase->back_brake = $request->back_brake;
        $purchase->body_type = $request->body_type;

        $purchase->purchase_price = $request->purchased_price;

        //vehicle-features
        //1 ->Yes
        //2 ->No
        if ($request->power_steering == 'Yes') {
            $purchase->power_steering = 1;
        }
        if ($request->power_steering == 'No') {
            $purchase->power_steering = 2;
        }

        if ($request->abs == 'Yes') {
            $purchase->abs = 1;
        }
        if ($request->abs == 'No') {
            $purchase->abs = 2;
        }

        if ($request->driver_air_bag == 'Yes') {
            $purchase->driver_air_bag = 1;
        }
        if ($request->driver_air_bag == 'No') {
            $purchase->driver_air_bag = 2;
        }

        if ($request->passenger_air_bag == 'Yes') {
            $purchase->passenger_air_bag = 1;
        }
        if ($request->passenger_air_bag == 'No') {
            $purchase->passenger_air_bag = 2;
        }

        if ($request->auto_climate == 'Yes') {
            $purchase->auto_climate_control = 1;
        }
        if ($request->auto_climate == 'No') {
            $purchase->auto_climate_control = 2;
        }

        if ($request->alloy_wheel == 'Yes') {
            $purchase->alloy_wheel = 1;
        }
        if ($request->alloy_wheel == 'No') {
            $purchase->alloy_wheel = 2;
        }

        if ($request->ac == 'Yes') {
            $purchase->ac = 1;
        }
        if ($request->ac == 'No') {
            $purchase->ac = 2;
        }


        $purchase->seller_name = strtoupper($request->seller_name);
        $purchase->phone = $request->seller_ph;
        $purchase->email = $request->seller_email;
        $purchase->address = $request->seller_address;

        $purchase->save();

        return 'success';
    }



        public function getPurchase(Request $request){

            $purchases = Purchase::with('brands','models');

            if ($request->from_date) {

                $purchases->where('created_at', '>=', $request->from_date);
            }
            if ($request->to_date) {

                $purchases->where('created_at', '<=', $request->to_date);
            }
            if (!$request->from_date && !$request->to_date) {
                $purchases->orderBy('created_at', 'desc');
            }

            return $purchases->orderBy('created_at', 'desc')->get();
        }


        public function deletePurchase($id)
        {
           $single_purchase_id = explode(',' , $id);

           foreach($single_purchase_id as $id) {
               Purchase::findOrFail($id)->delete();
           }
            return 'success';

        }
}
