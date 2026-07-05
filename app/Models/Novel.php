<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    protected $fillable = [
        'title',
        'author',
        'genre',
        'release_date',
        'description',
        'cover_image',
        'price',
        'rating',
        'file_path',
    ];

    // Relasi ke Order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    // Relasi ke Volume

}