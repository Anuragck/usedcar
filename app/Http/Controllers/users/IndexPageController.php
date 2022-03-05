<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\VehicleImage;
use Illuminate\Http\Request;

class IndexPageController extends Controller
{
    //
    public function getFeaturedCars(){



// $details[] = [
// 'images'=>VehicleImage::where('new_or_old','=','2')->get(),

// 'data'=>Purchase::with('brands', 'models', 'sales')->where('add_to_homepage', '=', '1')->where('add_to_website', '=', 1)->where('vehicle_status', '=', '1')->orderBy('id', 'DESC')->get()
// ];

// return $details;
        return Purchase::with('brands', 'models', 'sales','indexPageImages')->where('add_to_homepage', '=', '1')->where('add_to_website', '=', 1)->where('vehicle_status', '=', '1')->orderBy('id', 'DESC')->get();
    }
}
