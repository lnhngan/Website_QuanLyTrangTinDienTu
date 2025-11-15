<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'url', 'title', 'thumbnail'];

    public $timestamps = false;

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}