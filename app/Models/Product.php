<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use QueryScopes, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'price',
        'stock_quantity',
        'image',
        'created_at',
        'updated_at'
    ];

    // Quan hệ với bảng Color
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_color');
    }

    // Quan hệ với bảng Size
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size');
    }

    // Quan hệ với bảng ProductImage (nhiều ảnh)
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Quan hệ với bảng Category (một sản phẩm thuộc về nhiều danh mục)
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    // Quan hệ với bảng Tag (một sản phẩm có thể có nhiều thẻ)
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }

    // Quan hệ với bảng Order (một sản phẩm có thể nằm trong nhiều đơn hàng)
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product');
    }

    // Quan hệ với bảng Review (một sản phẩm có thể có nhiều đánh giá)
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
