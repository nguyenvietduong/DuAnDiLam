<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Friendship extends Model
{
    use HasFactory, QueryScopes;

    protected $fillable = [
        'user_id',
        'friend_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function friend()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }    
}
