<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'total_price'];

    // Relasi: satu order punya banyak order item
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relasi: order dimiliki oleh user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
