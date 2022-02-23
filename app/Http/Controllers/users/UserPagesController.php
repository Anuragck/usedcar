<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class UserPagesController extends Controller
{
    public function index(){
    return view('users.index');
    }

    public function about(){
        return view('users.about');
        }

    public function contact(){
        return view('users.contact');
            }

    public function allCarsPage(){
        // return view('users.allCarsPage');
       $allCars=Purchase::with('images')->where('add_to_website','=','1')->get();
    return view('users.allCarsPage',compact('allCars'));

            }



    public function Hyundaii20(){
        return view('users.CarsPages.Hyundaii20');

            }

    public function MaruthiBaleno(){
       return view('users.CarsPages.MaruthiBaleno');
        }

    public function HondaJazz(){
       return view('users.CarsPages.HondaJazz');
             }

    public function MaruthiWagonR(){
       return view('users.CarsPages.MaruthiWagonR');
            }

    public function MaruthiSwift(){
       return view('users.CarsPages.MaruthiSwift');
            }




}
