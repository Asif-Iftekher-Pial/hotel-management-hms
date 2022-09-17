<?php

namespace App\Models;

use App\Models\Room;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $fillable=[
        'customer_id','room_id','checkin','checkout','total_adults','total_children','payment_status'
    ];

    public function withcustomer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function withroom()
    {
        return $this->belongsTo(Room::class,'room_id','id');
    }
    
}
