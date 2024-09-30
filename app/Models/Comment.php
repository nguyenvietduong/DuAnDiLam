<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, QueryScopes, SoftDeletes;

    // Define the table name if it's not the default 'comments'
    protected $table = 'comments';

    // Define the fillable fields
    protected $fillable = [
        'id',
        'user_id',
        'post_id',
        'content',
        'status',
    ];

    /**
     * A comment belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A comment belongs to a post.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    /**
     * Scope for approved comments.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
