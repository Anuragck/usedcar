<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\BookingList;
use Illuminate\Http\Request;

class BookingListController extends Controller
{
    //
    public function getBookingList(){
        $bookingList = BookingList::with('vehicle.brands','vehicle.models','customer')->where('sale_status','=',0)->orderBy('id','DESC');
        return $bookingList->get();
    }
}
