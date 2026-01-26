<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'long_description',
        'price',
        'image_url',
        'category',
        'location',
        'photographer_id',
        'aperture',
        'shutter_speed',
        'iso',
        'focal_length',
        'options',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function photographer()
    {
        return $this->belongsTo(Photographer::class);
    }
}
