<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, QueryScopes, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'parent_id',
        'created_at',
        'updated_at',
    ];

    // Định nghĩa mối quan hệ với các danh mục con
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Định nghĩa mối quan hệ với danh mục cha
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Hàm đệ quy để lấy tất cả các danh mục con
    public function allChildren()
    {
        $children = collect([]);

        foreach ($this->children as $child) {
            $children->push($child);
            $children = $children->merge($child->allChildren());
        }

        return $children;
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_category');
    }
}
