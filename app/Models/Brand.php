<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'logo_url', 'website_url'];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
