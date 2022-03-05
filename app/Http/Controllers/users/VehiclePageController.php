<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class VehiclePageController extends Controller
{
    //

    public function singleVehicle($id)
    {

     $single_car=Purchase::with('brands', 'models', 'sales','newImages','indexPageImages')->where('id', '=', $id)->first();


         return view('users.singleCarPage',compact('single_car'));
     }



    public function allCars(Request $request){


        $all_cars=Purchase::with('brands', 'models', 'sales','newImages','indexPageImages')->where('add_to_website', '=', 1)->where('vehicle_status', '=', 1);

        if ($request->brand) {

            $all_cars->where('brand_id', '=', $request->brand);
        }

        if ($request->model) {

            $all_cars->where('model_id', '=', $request->model);
        }

        if ($request->fuel) {

            $all_cars->where('fuel', '=', $request->fuel);
        }

        if ($request->price == 1) {

            $all_cars ->orderBy('selling_price', 'ASC');
        }
        if ($request->price == 2) {

            $all_cars->orderBy('selling_price', 'DESC');
        }

        if (!$request->brand && !$request->model && !$request->price && !$request->fuel) {
            $all_cars->orderBy('id', 'desc');
        }

        return $all_cars->orderBy('id', 'desc')->get();
    }
}
