<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, QueryScopes, SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'image',
        'title',
        'content',
        'status',
        'views_count'
    ];

    // Định nghĩa scope để truy vấn bài viết "hot"
    public function scopeHot($query)
    {
        return $query->orderBy('views_count', 'desc');
    }

    // Định nghĩa scope để truy vấn bài viết "xu hướng"
    public function scopeTrending($query)
    {
        $weekAgo = now()->subWeek();
        return $query->where('created_at', '>=', $weekAgo)
            ->orderBy('views_count', 'desc');
    }

    // Scope để lấy các bài viết phổ biến.
    public function scopePopular($query)
    {
        return $query->orderBy('views_count', 'desc');
    }

    // Định nghĩa bài viết gần đây theo created_at
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function mentions()
    {
        return $this->belongsToMany(User::class, 'post_mentions', 'post_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
