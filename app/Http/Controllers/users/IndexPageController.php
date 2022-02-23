<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class IndexPageController extends Controller
{
    //
    public function getFeaturedCars(){
        return Purchase::with('brands', 'models', 'sales','indexPageImages')->where('add_to_homepage', '=', '1')->where('vehicle_status', '=', '1')->orderBy('id', 'DESC')->get();
    }
}
