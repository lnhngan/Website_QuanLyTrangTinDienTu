{{-- resources/views/author/articles/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Bài viết của bạn')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-info mb-0">Bài viết của bạn</h4>
    <a href="{{ route('author.articles.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Thêm bài viết
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Chuyên mục</th>
                        <th>Trạng thái</th>
                        <th>Lượt xem</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>
                            <strong>{{ $article->title }}</strong>
                        </td>
                        <td>{{ $article->category?->name ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $article->status === 'published' ? 'success' : 'warning' }}">
                                {{ $article->status === 'published' ? 'Đã đăng' : 'Bản nháp' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $article->views }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('author.articles.edit', $article) }}"
                               class="btn btn-sm btn-warning text-white" title="Sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('author.articles.destroy', $article) }}" method="POST"
                                  class="d-inline" onsubmit="return confirm('Xóa bài viết này?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Bạn chưa có bài viết nào. <a href="{{ route('author.articles.create') }}">Đăng bài đầu tiên!</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $articles->links() }}
        </div>
    </div>
</div>
@endsection