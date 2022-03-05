<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function brands() {
        return $this->belongsTo(Brand::class,'brand_id','id')->withTrashed();
    }
    public function models() {
        return $this->belongsTo(VehicleModel::class,'model_id','id')->withTrashed();
    }
    public function images(){
        return $this->hasMany(VehicleImage::class,'vehicle_id','id');
    }

    public function newImages(){
        return $this->hasMany(VehicleImage::class,'vehicle_id','id')->where('new_or_old','=',2);
    }

    public function customer() {
        return $this->belongsTo(Enquiry::class,'reg_no','enq_vehicle_reg_no')->withTrashed();
    }
    public function sales() {
        return $this->belongsTo(Sale::class,'id','vehicle_id')->withTrashed();
    }

    public function indexPageImages(){
        return $this->hasMany(VehicleImage::class,'vehicle_id','id')->where('type','=',1)->where('new_or_old','=',2);

    }

    public function expenses(){
        return $this->hasMany(Expense::class,'vehicle_id','id');
    }
}
