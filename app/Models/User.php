<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'image',
        'phone',
        'address',
        'role',
        'created_at',
        'updated_at',
    ];

    const TYPE_ADMIN    = "sysadmin";
    const TYPE_USER     = "user";

    public function isAdmin()
    {
        return $this->type === self::TYPE_ADMIN; // Thay 'role' bằng trường thích hợp trong bảng users của bạn
    }

    public function isUser()
    {
        return $this->type === self::TYPE_USER; // Thay 'role' bằng trường thích hợp trong bảng users của bạn
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function sentChats()
    {
        return $this->hasMany(Chat::class, 'user_id');
    }

    public function receivedChats()
    {
        return $this->hasMany(Chat::class, 'manager_id');
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
            ->wherePivot('status', 'accepted'); // Assuming 'accepted' is the status for a valid friendship
    }
    
    public function countFriends()
    {
        return $this->friends()->count();
    }    

    public function friendRequests()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
            ->wherePivot('status', 'pending');
    }
}
