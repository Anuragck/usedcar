<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;

class DeliveryListController extends Controller
{
    //
    public function getDeliveryList(Request $request)
    {
        $delivery_list = Purchase::with('brands', 'models', 'sales', 'customer');

        if ($request->from_date) {

            $delivery_list->where('created_at', '>=', $request->from_date) ->where('sale_status', '=', 2);;
        }
        if ($request->to_date) {

            $delivery_list->where('created_at', '<=', $request->to_date) ->where('sale_status', '=', 2);;
        }
        if (!$request->from_date && !$request->to_date) {
            $delivery_list->orderBy('created_at', 'desc') ->where('sale_status', '=', 2);;
        }

        return $delivery_list->orderBy('created_at', 'desc')->get();



    }

    public function rcTransfer(Request $request)
    {

        $request->validate([
            'transfer_date' => "required",
        ]);

        if ($request->vehicle_id) {
            $delivered = Sale::where('vehicle_id', '=', $request->vehicle_id)->first();
            $delivered->rc_transfer_date = $request->transfer_date;
            $delivered->rc_transfer_status = 1;
        }
        $delivered->save();
        return 'success';
    }
}
