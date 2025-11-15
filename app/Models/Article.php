<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'slug',
        'summary',
        'content',
        'thumbnail',
        'status',
        'published_at',
        // 'views' KHÔNG ĐƯỢC ĐẶT Ở ĐÂY → chỉ tăng bằng code
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
        'views'        => 'integer',
    ];

    // === MỐI QUAN HỆ ===
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    // === SCOPE ===
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    // === HELPER ===
    public function incrementViews()
    {
        $this->increment('views');
    }
}