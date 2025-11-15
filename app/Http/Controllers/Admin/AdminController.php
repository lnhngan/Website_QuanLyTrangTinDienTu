<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // For demo: in real app add middleware('auth','can:admin')
    }

    public function dashboard()
    {
        $articles = Article::latest()->take(6)->get();
        return view('admin.dashboard', compact('articles'));
    }

    public function articles()
    {
        $articles = Article::with('category','author')->latest()->paginate(15);
        return view('admin.articles', compact('articles'));
    }

    public function createArticle()
    {
        $categories = Category::all();
        return view('admin.create_article', compact('categories'));
    }

    public function storeArticle(Request $request)
    {
        $data = $request->validate([
            'title'=>'required|string|max:200',
            'slug'=>'required|string|max:200|unique:articles,slug',
            'content'=>'required',
            'category_id'=>'required|exists:categories,id',
            'status'=>'required|in:draft,published,archived',
        ]);
        $data['author_id'] = auth()->id() ?? 1;
        Article::create($data);
        return redirect()->route('admin.articles')->with('success','Article created');
    }

    // Edit/Delete omitted for brevity in demo skeleton
}
