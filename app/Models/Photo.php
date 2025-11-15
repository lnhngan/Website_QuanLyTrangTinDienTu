<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'url', 'caption'];

    public $timestamps = false;

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}