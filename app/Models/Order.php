<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
    ];

    // Relasi: Order milik 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Order punya banyak OrderItem
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relasi: Order punya 1 Payment
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
