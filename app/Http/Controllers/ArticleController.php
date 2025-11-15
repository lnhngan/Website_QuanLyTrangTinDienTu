<?php

namespace App\Http\Controllers;

use App\Models\Article; // Dùng Model Article
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Hiển thị chi tiết một bài viết.
     * Tên biến $slug phải KHỚP với {slug} trong file route.
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
                        ->with(['author', 'category', 'tags'])
                        ->firstOrFail();

        // Tăng lượt xem
        $article->increment('views');

        // Bài liên quan: cùng danh mục, khác ID, lấy 3
        $relatedArticles = Article::where('category_id', $article->category_id)
                                ->where('id', '!=', $article->id)
                                ->where('status', 'published')
                                ->latest('published_at')
                                ->take(3)
                                ->get();

        return view('article.article_detail', compact('article', 'relatedArticles'));
    }

    // app/Http/Controllers/Admin/ArticleController.php (resource controller)
    public function create()
        {
            $categories = Category::all();
            $authors = User::whereIn('role', ['admin', 'editor', 'reporter'])->get();
            $tags = Tag::all();
            return view('admin.articles.create', compact('categories', 'authors', 'tags'));
        }
        
    public function store(ArticleRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? \Str::slug($data['title']);
        $data['author_id'] = $data['author_id'] ?? auth()->id();
        if ($data['status'] === 'published') {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $article = Article::create($data);

        // Tags
        if ($request->tags) {
            $article->tags()->sync($request->tags);
        }

        // Photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'public');
                $article->photos()->create(['url' => $path, 'caption' => $request->input('photo_captions')[$loop->index] ?? '']);
            }
        }

        // Video
        if ($request->video_url) {
            $article->videos()->create([
                'url' => $request->video_url,
                'title' => $request->video_title,
                // Thumbnail từ YouTube nếu cần: dùng API hoặc regex
            ]);
        }

        return redirect()->route('admin.articles.index')->with('success', 'Thêm bài viết thành công!');
    }
}