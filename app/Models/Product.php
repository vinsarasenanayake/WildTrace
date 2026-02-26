<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    protected $appends = ['is_favorite'];

    public function getIsFavoriteAttribute()
    {
        $user = Auth::user() ?? Auth::guard('sanctum')->user();
        if (!$user)
            return false;

        return \App\Models\Favorite::where('user_id', $user->id)
            ->where('product_id', $this->id)
            ->exists();
    }

    public function photographer()
    {
        return $this->belongsTo(Photographer::class);
    }
}
