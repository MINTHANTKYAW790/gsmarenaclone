<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    use HasFactory;
    protected $fillable = [
        'device_id',
        'spec_category_id',
        'key',
        'value',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function specCategory()
    {
        return $this->belongsTo(SpecCategory::class);
    }
}
