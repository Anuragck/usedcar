<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\VehicleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImagesController extends Controller
{
    public function getVehicleImage(Request $request)
    {

        $purchases = Purchase::with('brands', 'models')->where('reg_no', '=', $request->reg_no);
        return $purchases->get();
    }


    public function addRegCert(Request $request)
    {

        $rc = Purchase::find($request->vehicle_id);


        if ($request->hasFile('cert_file')) {
            $rc_ext = $request->file('cert_file')->getClientOriginalExtension();
            $rc_filename = $request->reg_no . ' ' . time() . '.' . $rc_ext;
            $path = $request->file('cert_file')->move(public_path('uploads/vehicleDocuments/rc'), $rc_filename); //pdf save public folder / uploads/course_syllabus
            $rc->reg_certificate = $rc_filename;
        }

        $rc->save();
        return 'success';
    }

    public function DeleteRc(Request $request)
    {
        if ($request->id) {


            $rc = Purchase::find($request->id);
            $current_rc = $rc->reg_certificate;

            $exist_rc = public_path('uploads/vehicleDocuments/rc/' . $current_rc);
            if (file_exists($exist_rc)) {
                @unlink($exist_rc);
            }
            $rc->reg_certificate = null;
            $rc->save();
            return 'success';
        } else {

            return "failed";
        }
    }


    public function addInsurance(Request $request){


        $purchase_insurance = Purchase::find($request->vehicle_id);


        if ($request->hasFile('insurance_file')) {
            $insurance_ext = $request->file('insurance_file')->getClientOriginalExtension();
            $insurance_filename = $request->reg_no . ' ' . time() . '.' . $insurance_ext;
            $path = $request->file('insurance_file')->move(public_path('uploads/vehicleDocuments/insurance'), $insurance_filename); //pdf save public folder / uploads/course_syllabus
            $purchase_insurance->insurance = $insurance_filename;
        }

        $purchase_insurance->save();
        return 'success';

    }


    public function deleteInsurance(Request $request)
    {
        if ($request->id) {


            $purchase_insurance = Purchase::find($request->id);
            $current_insurance = $purchase_insurance->insurance;

            $exist_insur = public_path('uploads/vehicleDocuments/insurance/' . $current_insurance);
            if (file_exists($exist_insur)) {
                @unlink($exist_insur);
            }
            $purchase_insurance->insurance = null;
            $purchase_insurance->save();
            return 'success';
        } else {

            return "failed";
        }
    }



    public function addAddressProof(Request $request){


        $purchase_address_proof = Purchase::find($request->vehicle_id);


        if ($request->hasFile('address_proof_file')) {
            $address_ext = $request->file('address_proof_file')->getClientOriginalExtension();
            $address_filename = $request->reg_no . ' ' . time() . '.' . $address_ext;
            $path = $request->file('address_proof_file')->move(public_path('uploads/vehicleDocuments/seller_address'), $address_filename); //pdf save public folder / uploads/course_syllabus
            $purchase_address_proof->address_proof = $address_filename;
        }

        $purchase_address_proof->save();
        return 'success';

    }

    public function deleteAddress(Request $request)
    {
        if ($request->id) {


            $purchase_address_proof = Purchase::find($request->id);
            $current_address_proof = $purchase_address_proof->address_proof;

            $exist_addr_proof = public_path('uploads/vehicleDocuments/seller_address/' . $current_address_proof);
            if (file_exists($exist_addr_proof)) {
                @unlink($exist_addr_proof);
            }
            $purchase_address_proof->address_proof = null;
            $purchase_address_proof->save();
            return 'success';
        } else {

            return "failed";
        }
    }


    public function addImage(Request $request){

        $request->validate([
            'img_type' => 'required',
        ]);

        $purchase = Purchase::find($request->vehicle_id);
if ($request->hasFile('image')) {

    $itemImage = new VehicleImage();

    $image_ext = $request->file('image')->getClientOriginalExtension();
    $img_filename = $request->reg_no . time() . '.' . $image_ext;
    $path = $request->file('image')->move(public_path('uploads/vehicleImages'), $img_filename); //pdf save public folder / uploads/course_syllabus


    $itemImage->user_id = Auth::user()->id;
    $itemImage->vehicle_id = $request->vehicle_id;
    $itemImage->image = $img_filename;

    //type 1->Front view image
    //type 2->Other image
    $itemImage->type = $request->img_type;
    //1 for NEW
    //2 for OLD

if($purchase->vehicle_status == 1){
    $itemImage->new_or_old = 2;
}else
$itemImage->new_or_old = 1;


    $itemImage->save();

  }

  return 'success';

    }



    public function getImages(Request $request){
        $images = VehicleImage::where('vehicle_id', '=', $request->vehicle_id)->where('new_or_old','=',1);
        return $images->get();
    }

    public function getNewImages(Request $request){
        $new_images = VehicleImage::where('vehicle_id', '=', $request->vehicle_id)->where('new_or_old','=',2);
        return $new_images->get();
    }


public function removeImage(Request $request){
    if ($request->id) {

        $v_image = VehicleImage::find($request->id);
        $current_img = $v_image->image;

        $exist_v_img = public_path('uploads/vehicleImages/'. $current_img);
        if (file_exists($exist_v_img)) {
            @unlink($exist_v_img);
        }
        $v_image->findOrFail($request->id)->delete();
        return 'success';
    } else {

        return "failed";
    }
}

}
