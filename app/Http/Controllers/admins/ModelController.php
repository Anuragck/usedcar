<?php

namespace App\Http\Controllers\admins;

use App\Models\VehicleModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ModelController extends Controller
{
    public function addModel(Request $request)
    { {

            $request->validate([

                "brand_id"  => 'required',

                "model_name"   => 'required',

            ]);


            if ($request->id) {

                $model = VehicleModel::find($request->id);
            } else

            $model = new VehicleModel;
            $model->user_id = Auth::user()->id;
            $model->brand_id = $request->brand_id;
            $model->name = strtoupper($request->model_name);


            $model->save();
            return 'success';
        }
    }

public function getModels(Request $request){
    $models = VehicleModel::with('vehicleBrand')->orderBy('id','DESC');

    if($request->brand){

        $models->where('brand_id','=',$request->brand);
    }


    return  $models->get();
}


public function deleteModel($id)
    {
       $single_model_id = explode(',' , $id);

       foreach($single_model_id as $id) {
           VehicleModel::findOrFail($id)->delete();
       }
        return 'success';

    }


public function getModelByBrand(Request $request){

$model=VehicleModel::orderBy('id','DESC');
    if($request->brand){
        $model->where('brand_id','=',$request->brand);
    }
    return $model->get();
}
}
