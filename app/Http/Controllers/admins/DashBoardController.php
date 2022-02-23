<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\BookingList;
use App\Models\Expense;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function getDashboardData(){
        $purchases =  Purchase::with('brands', 'models');
        $sales =  Sale::all();
        $bookings =  BookingList::where('sale_status','=',0);
        $rc_transfer =  Sale::where('rc_transfer_status','=',0);
        $expenses =  Expense::all();


        $details[] = [

            'total_no_purchases'  => $purchases->count(),
            'total_no_sales'  => $sales->count(),
            'total_no_bookings'  => $bookings->count(),
            'rc_transfer_pending'=>$rc_transfer->count(),

            'total_purchase_amount'=>$purchases->sum('purchase_price'),
            'total_sales_amount'=>$sales->sum('sale_price'),
            'total_expenses_amount'=>$expenses->sum('amount'),


        ];
        return $details;

    }
}
