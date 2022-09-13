<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    protected $fillable=['room_id','customer_id','customer_review','star'];
    
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
}
