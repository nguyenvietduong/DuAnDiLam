<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'status',
        'total_price',
        'created_at',
        'updated_at',
    ];

    // Quan hệ với User (một đơn hàng thuộc về một người dùng)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với Product (một đơn hàng có nhiều sản phẩm)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')
            ->withPivot('quantity', 'price'); // Bảng trung gian lưu quantity và price
    }

    // Quan hệ với Review (một đơn hàng có thể có nhiều đánh giá)
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
