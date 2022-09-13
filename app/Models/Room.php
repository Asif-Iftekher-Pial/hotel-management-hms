<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable=[
        'status','room_type_id','title','room_service_id','photo','size','price',
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class,'room_type_id','id');
    }
    public function service()
    {
        return $this->hasOne(RoomService::class,'id','room_service_id');
    }

    
}
