<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;


class ExpenseController extends Controller
{
    public function save(Request $request)
    {



        $request->validate([
            'categories_id' => "required",
            'pay_date' => 'required',
            'pay_type' => "required",
            'amount' => "required|gt:0"
        ]);

        if ($request->id) {
            $expense = Expense::find($request->id);
        } else
            $expense = new Expense;


        $expense->expense_category_id = $request->categories_id;
        $expense->vehicle_id = $request->vehicle_id;
        $expense->pay_date = $request->pay_date;
        $expense->amount = $request->amount;

        //adding expense to total expense of purchase table
        $purchase = Purchase::FindOrFail($request->vehicle_id);
        if ($purchase->total_expenses != null) {
            $purchase->total_expenses = $purchase->total_expenses + $request->amount;
        } else {
            $purchase->total_expenses = $request->amount;
        }

        $purchase->save();


        $expense->pay_type = $request->pay_type;
        if ($request->remarks)
            $expense->remarks = strtoupper($request->remarks);
        else
            $expense->remarks = "NO REMARKS GIVEN";
        $expense->user_id = Auth::user()->id;
        $expense->save();
        return 'success';
    }



    public function getHistory(Request $request)
    {
        if ($request->id) {
            $history = Expense::with('expenseCategory')->where('vehicle_id', '=', $request->id)->orderBy('id', 'DESC')->get();
            return $history;
        }
    }


    public function expenseReport(Request $request){
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
}
