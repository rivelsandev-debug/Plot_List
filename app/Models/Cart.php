<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'novel_id',
        'volume_id',
    ];

    // Relasi ke Volume


    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Novel
    public function novel()
    {
        return $this->belongsTo(Novel::class);
    }
}