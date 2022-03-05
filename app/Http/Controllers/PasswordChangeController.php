<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
    //
    public function changePassword(Request $request){



        //Validate the Password.
         $request->validate([
            'currentPassword' => 'required',
            'password'     => ['required', 'string', 'min:8', 'confirmed']
        ]);
            //Check if the Current Password matches with what is in the database.
            if(!(Hash::check($request->currentPassword, Auth::user()->password))) {
                return 'mismatch';
            }

            // Compare the Current Password and New Password using[strcmp function]
            if(strcmp($request->currentPassword, $request->password) == 0) {
                return 'doNotSamePw';
            }


        $changed=User::find(auth()->user()->id)->update(['password' => Hash::make($request->password_confirmation)]);
        if($changed){
            return 'changed';
        }else{
            return 'notChanged';
        }





    }
}
