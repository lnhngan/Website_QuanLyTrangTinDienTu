<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    public $timestamps = true;  // Bật timestamps nếu tắt trước

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($tag) {
            $tag->slug = Str::slug($tag->name);
        });
        static::updating(function ($tag) {
            $tag->slug = Str::slug($tag->name);
        });
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tags');
    }
}