<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
        public function index(Request $request)
    {
        $tags = Tag::withCount('articles')
            ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->latest()
            ->paginate(15);

        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
            'description' => 'nullable|string|max:500',
        ]);

        Tag::create($validated);

        return redirect()->route('admin.tags.index')->with('success', 'Thêm tag thành công!');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
            'description' => 'nullable|string|max:500',
        ]);

        $tag->update($validated);

        return redirect()->route('admin.tags.index')->with('success', 'Cập nhật tag thành công!');
    }

    public function destroy(Tag $tag)
    {
        if ($tag->articles()->count() > 0) {
            return back()->with('error', 'Không thể xóa tag đang được sử dụng trong bài viết!');
        }

        $tag->delete();

        return back()->with('success', 'Xóa tag thành công!');
    }
}