<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'avatar'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'integer',  // 1=admin, 2=editor, 3=user
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    //Phan quyen
    public function isAdmin(): bool
    {
        return $this->role === 1;
    }

    public function isEditor(): bool
    {
        return $this->role === 2;
    }

    public function isUser(): bool
    {
        return $this->role === 3;
    }

    public function getRoleNameAttribute(): string
    {
        return match ($this->role) {
            1 => 'Admin',
            2 => 'Tác giả',
            3 => 'Người dùng',
            default => 'Không xác định',
        };
    }
}