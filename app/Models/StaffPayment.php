<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffPayment extends Model
{
    use HasFactory;
    protected $fillable=[
        'staff_id','amount','payment_date'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class,'staff_id','id');
    }
}
