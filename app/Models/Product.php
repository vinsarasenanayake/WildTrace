<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Fillable attributes
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

    // Attribute casting
    protected $casts = [
        'options' => 'array',
    ];

    // Appended attributes
    protected $appends = ['is_favorite'];

    // Favorite status accessor
    public function getIsFavoriteAttribute()
    {
        // Try web auth first, then sanctum for API
        $user = auth()->user() ?? auth('sanctum')->user();
        if (!$user)
            return false;

        return \App\Models\Favorite::where('user_id', $user->id)
            ->where('product_id', $this->id)
            ->exists();
    }

    // Photographer relationship
    public function photographer()
    {
        return $this->belongsTo(Photographer::class);
    }
}
