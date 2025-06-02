<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_id',
        'name',
        'release_date',
        'price',
        'image_url',
        'os',
        'device_type',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function specs()
    {
        return $this->hasMany(Spec::class);
    }

    public function specValue($categoryId, $key)
    {
        return $this->specs()
            ->where('spec_category_id', $categoryId)
            ->where('key', $key)
            ->first()
            ->value ?? '—';
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'saved_devices')->withTimestamps();
    }
}
