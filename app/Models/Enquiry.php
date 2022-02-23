<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function getFollowUp(){
        return $this->hasMany(FollowUpEntry::class,'enq_id','id');
        }

        public function brands() {
            return $this->belongsTo(Brand::class,'enq_brand','id')->withTrashed();
        }
        public function models() {
            return $this->belongsTo(VehicleModel::class,'enq_model','id')->withTrashed();
        }

}
