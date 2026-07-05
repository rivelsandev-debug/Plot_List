<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'novel_id',
        'volume_id',
        'amount',
        'status',
        'snap_token',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Volume
// Relasi ke Novel
    public function novel()
    {
        return $this->belongsTo(Novel::class);
    }
}