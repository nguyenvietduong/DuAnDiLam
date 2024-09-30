<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'order_id',
        'rating',
        'comment',
        'created_at',
        'updated_at',
    ];

    // Quan hệ với User (một đánh giá thuộc về một người dùng)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với Product (một đánh giá thuộc về một sản phẩm)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Quan hệ với Order (một đánh giá thuộc về một đơn hàng)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
