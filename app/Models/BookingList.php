<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingList extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function vehicle() {
        return $this->belongsTo(Purchase::class,'vehicle_id','id')->withTrashed();
    }
    public function customer() {
        return $this->belongsTo(Enquiry::class,'enq_id','id')->withTrashed();
    }
}
