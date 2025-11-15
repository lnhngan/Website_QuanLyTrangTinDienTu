<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::with('parent')
            ->withCount('articles')
            ->oldest()
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Tự động sinh slug nếu trống
        if (empty($data['slug'])) {
            $data['slug'] = \Str::slug($data['name']);
        } else {
            $data['slug'] = \Str::slug($data['slug']);
        }

        Category::create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Thêm chuyên mục thành công!');
    }

    public function edit(Category $category): View
    {
        $categories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->get();

        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = \Str::slug($data['name']);
        } else {
            $data['slug'] = \Str::slug($data['slug']);
        }

        $category->update($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Cập nhật chuyên mục thành công!');
    }

    public function destroy(Category $category): RedirectResponse
    {
        // Nếu có bài viết → chuyển sang "Không phân loại" (id=1) hoặc xóa
        if ($category->articles()->exists()) {
            return back()->with('error', 'Không thể xóa: Có bài viết thuộc chuyên mục này!');
        }

        $category->delete();

        return back()->with('success', 'Xóa chuyên mục thành công!');
    }
}