<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $fillable=[
        'title','detail','price'
    ];
    
    public function room_type_image()
    {
        return $this->hasMany(RoomTypeImage::class,'room_type_id','id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class,'room_type_id','id');
    }
}
