<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class VehicleListController extends Controller
{
    public function vehilceList(){
        $vehiclelist =Purchase::with('brands','models')->where('vehicle_status','=',0)->orderBy('id','DESC')->get();
        return $vehiclelist;
}


public function sellReady(Request $request){

    $request->validate([
        'selling_price' => 'required',
        'description'=>'required',
    ]);

        if($request->vehicle_id){
            $vehicle= Purchase::FindOrFail($request->vehicle_id);

            $vehicle->vehicle_status=1;
            $vehicle->selling_price=$request->selling_price;
            $vehicle->description=$request->description;

            $vehicle->save();
            return 'success';
        }

}



public function readyVehicles(){
    $vehiclelist =Purchase::with('brands','models')->where([['vehicle_status','=',1],['sale_status','!=',2]])->orderBy('id','DESC')->get();
    return $vehiclelist;
}
}
