<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard='customers';
    protected $fillable=[
        'full_name','email','password','mobile','address','photo','status'
    ];

    public function booking()
    {
        return $this->hasMany(Booking::class,'customer_id','id');
    }

    
}
