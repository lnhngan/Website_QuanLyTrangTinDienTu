<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::with(['author', 'category'])
            ->withCount('comments')
            ->oldest() // Cũ → Mới (hoặc latest() nếu muốn mới nhất lên đầu)
            ->paginate(10);

        return view('admin.articles.index', compact('articles'));
    }

    // app/Http/Controllers/Admin/ArticleController.php

    public function create(): View
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.articles.create', compact('categories', 'tags'));
        // KHÔNG truyền $article
    }

    public function store(ArticleRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Slug
        $data['slug'] = empty($data['slug']) ? \Str::slug($data['title']) : \Str::slug($data['slug']);

        // Author
        $data['author_id'] = auth()->id();

        // Thumbnail
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // Published at
        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $article = Article::create($data);

        // Tags
        if ($request->filled('tags')) {
            $article->tags()->sync($request->tags);
        }

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Thêm bài viết thành công!');
    }

    public function show(Article $article): View
    {
        $article->load(['author', 'category', 'tags', 'comments.user']);
        $article->incrementViews();
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article): View
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.articles.edit', compact('article', 'categories', 'tags'));
    }

    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        $data = $request->validated();

        $data['slug'] = empty($data['slug']) ? \Str::slug($data['title']) : \Str::slug($data['slug']);

        if ($request->hasFile('thumbnail')) {
            // Xóa ảnh cũ
            if ($article->thumbnail) {
                \Storage::disk('public')->delete($article->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $article->update($data);

        $article->tags()->sync($request->tags ?? []);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Cập nhật bài viết thành công!');
    }

    public function destroy(Article $article): RedirectResponse
    {
        if ($article->thumbnail) {
            \Storage::disk('public')->delete($article->thumbnail);
        }
        $article->delete();

        return back()->with('success', 'Xóa bài viết thành công!');
    }
}