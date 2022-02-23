<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function addBrand(Request $request)
    {

        $request->validate([



            "brand_name"  => 'required',

            // "brand_logo"   => 'required|image|mimes:jpeg,png,jpg,svg|max:200',


        ]);


        if ($request->id) {

            $brand = Brand::find($request->id);
        } else

            $brand = new Brand;
        $brand->user_id = Auth::user()->id;
        $brand->name = strtoupper($request->brand_name);


        $current_logo = $brand->logo;




        if ($request->hasFile('brand_logo')) {

            $exist_logo = public_path('uploads/brand/' . $current_logo);
            if (file_exists($exist_logo)) {
                @unlink($exist_logo);
            }


            $img_ext = $request->file('brand_logo')->getClientOriginalExtension();

            $size = $request->file('brand_logo')->getSize();



            $filename = $request->brand_name  . time() . '.' . $img_ext;
            $path = $request->file('brand_logo')->move(public_path('uploads/brand'), $filename); //image save public folder / uploads/category_upload
            $brand->logo = $filename;
        }






        $brand->save();
        return 'success';
    }



    public function getBrands()
    {
        $brands = Brand::orderBy('id', 'DESC')->get();
        return $brands;
    }

    public function deleteBrands($id)
    {
       $single_brand_id = explode(',' , $id);

       foreach($single_brand_id as $id) {
           Brand::findOrFail($id)->delete();
       }
        return 'success';

    }
}
