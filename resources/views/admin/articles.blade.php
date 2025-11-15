@extends('layouts.app')

@section('content')
  <div class="bg-white rounded-lg shadow p-4">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-bold">Quản lý bài viết</h2>
      <a href="{{ route('admin.articles.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">Tạo mới</a>
    </div>

    <table class="w-full table-auto">
      <thead>
        <tr class="text-left">
          <th class="p-2">ID</th>
          <th class="p-2">Tiêu đề</th>
          <th class="p-2">Chuyên mục</th>
          <th class="p-2">Tác giả</th>
          <th class="p-2">Trạng thái</th>
        </tr>
      </thead>
      <tbody>
        @foreach($articles as $a)
        <tr class="border-t">
          <td class="p-2">{{ $a->id }}</td>
          <td class="p-2">{{ $a->title }}</td>
          <td class="p-2">{{ $a->category->name ?? '' }}</td>
          <td class="p-2">{{ $a->author->name ?? '' }}</td>
          <td class="p-2">{{ $a->status }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="mt-4">{{ $articles->links() }}</div>
  </div>
@endsection
