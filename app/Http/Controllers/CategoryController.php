<?php

namespace App\Http\Controllers;

use App\Models\Category; // <-- Dùng Model Category
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Hiển thị các bài viết theo 1 danh mục
     */
    public function show($slug)
    {
        // 1. Tìm danh mục bằng slug, nếu không thấy thì báo 404
        $category = Category::where('slug', $slug)->firstOrFail();

        // 2. Lấy các bài viết (đã published) thuộc danh mục đó
        // (Đây là lúc hàm articles() ở Bước 1 phát huy tác dụng)
        $articles = $category->articles()
                            ->where('status', 'published')
                            ->latest()
                            ->paginate(10);

        // 3. Trả về 1 view (sẽ tạo ở bước sau)
        return view('category_show', [
            'category' => $category,
            'articles' => $articles,
        ]);
    }
}