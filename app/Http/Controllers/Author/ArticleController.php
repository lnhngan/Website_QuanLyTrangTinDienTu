<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = auth()->user()->articles()
            ->with('category')
            ->withCount('comments')
            ->latest()
            ->paginate(15);

        return view('author.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('author.articles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $data['author_id'] = auth()->id();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        Article::create($data);

        return redirect()->route('author.articles.index')->with('success', 'Đăng bài thành công!');
    }

    public function edit(Article $article)
    {
        $this->authorizeArticle($article);
        return view('author.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $this->authorizeArticle($article);

        $data = $request->validate([
            'title' => 'required|string|max:200',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('author.articles.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Article $article)
    {
        $this->authorizeArticle($article);
        $article->delete();
        return back()->with('success', 'Xóa bài thành công!');
    }

    private function authorizeArticle(Article $article)
    {
        if ($article->author_id !== auth()->id()) {
            abort(403);
        }
    }
}