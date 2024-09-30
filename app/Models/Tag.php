<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, QueryScopes, SoftDeletes;

    protected $fillable = [
        'id', 
        'name',
        'slug',
        'created_at',
        'updated_at',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag','tag_id', 'post_id');
    }
}
