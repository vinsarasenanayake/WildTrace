<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photographer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'profession',
        'achievement',
        'quote',
        'post',
        'image',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
