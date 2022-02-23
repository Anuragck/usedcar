<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class ReadyVehiclesController extends Controller
{
public function add(Request $request){
    if($request->id){
        $vehicle= Purchase::FindOrFail($request->id);

        $vehicle->add_to_website=1;

        $vehicle->save();
        return 'success';
    }
}

public function remove(Request $request){
    if($request->id){
        $vehicle= Purchase::FindOrFail($request->id);

        $vehicle->add_to_website=0;

        $vehicle->save();
        return 'success';
    }
}

public function addHome(Request $request){
    if($request->id){
        $vehicle= Purchase::FindOrFail($request->id);

        if($vehicle->add_to_homepage == 1){
            $vehicle->add_to_homepage=0;
        }else
        $vehicle->add_to_homepage=1;

        $vehicle->save();
        return 'success';
    }
}
}
