<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\Auth;

class ExpenseCategoryController extends Controller
{
    public function addExpenseCategory(Request $request)
    {
        $request->validate([
            'expensecategory_name' => 'required',
        ]);

        if ($request->id) {
            $expensecategory = ExpenseCategory::find($request->id);
        } else {
            $expensecategory = new ExpenseCategory();
        }
        $expensecategory->user_id = Auth::user()->id;

        $expensecategory->name = $request->expensecategory_name;

        $expensecategory->save();
        return 'success';
    }

    public function getExpenseCategories(Request $request)
    {
        $expensecategory = ExpenseCategory::orderBy('id', 'DESC')->get();
        return $expensecategory;
    }

    public function deleteExpenseCategory($id)
    {
        $single_expensecategory_id = explode(',', $id);

        foreach ($single_expensecategory_id as $id) {
            ExpenseCategory::findOrFail($id)->delete();
        }
        return 'success';
    }
}
