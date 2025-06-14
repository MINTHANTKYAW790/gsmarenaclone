<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'user_id',
        'heading',
        'image_1',
        'paragraph_1',
        'image_2',
        'paragraph_2',
        'rating',
        'logo1',
        'link1',
        'logo2',
        'link2',
        'logo3',
        'link3',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
