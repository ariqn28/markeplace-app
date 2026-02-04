<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Kolom yang bisa diisi
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'category_id',
    ];

    /**
     * Relasi: produk milik satu kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi: produk bisa muncul di banyak order item
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
