<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function specs()
    {
        return $this->hasMany(Spec::class);
    }
}
