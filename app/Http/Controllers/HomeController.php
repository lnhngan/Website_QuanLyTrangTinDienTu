<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // LẤY TIN NỔI BẬT
        $featured = Article::where('status', 'published')
                           ->where('featured', 1)
                           ->latest('published_at')
                           ->take(3)
                           ->get();

        // LẤY TIN MỚI NHẤT (phân trang)
        $articles = Article::where('status', 'published')
                           ->latest('published_at')
                           ->paginate(10);

        // LẤY TIN NHANH
        $quickArticles = Article::where('status', 'published')
                                ->latest()
                                ->take(5)
                                ->get();

        // LẤY DANH MỤC (nếu cần)
        $categories = Category::all();

        return view('home', compact('featured', 'articles', 'quickArticles', 'categories'));
    }
}