<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;

class TagController extends Controller
{
    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $articles = Article::whereHas('tags', function ($q) use ($tag) {
                        $q->where('id', $tag->id);
                    })
                    ->where('status', 'published')
                    ->latest('published_at')
                    ->paginate(10);

        return view('tag.show', compact('tag', 'articles'));
    }
}