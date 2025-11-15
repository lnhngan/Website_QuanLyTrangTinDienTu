{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Bảng điều khiển')

@section('content')
<div class="row g-4">
    <!-- Stats Cards -->
    <div class="col-md-3">
        <div class="card stat-card text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1 opacity-75">Tổng bài viết</h6>
                    <h3 class="mb-0">{{ $totalArticles }}</h3>
                </div>
                <i class="fas fa-newspaper fa-2x opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1 opacity-75">Đã xuất bản</h6>
                    <h3 class="mb-0">{{ $publishedArticles }}</h3>
                </div>
                <i class="fas fa-check-circle fa-2x opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1 opacity-75">Nháp</h6>
                    <h3 class="mb-0">{{ $draftArticles }}</h3>
                </div>
                <i class="fas fa-edit fa-2x opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1 opacity-75">Tổng lượt xem</h6>
                    <h3 class="mb-0">{{ number_format($totalViews) }}</h3>
                </div>
                <i class="fas fa-eye fa-2x opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Articles -->
<div class="mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Bài viết gần đây</h5>
        <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-outline-primary">
            Xem tất cả
        </a>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Tác giả</th>
                            <th>Trạng thái</th>
                            <th>Lượt xem</th>
                            <th>Ngày</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentArticles as $article)
                        <tr>
                            <td>
                                <a href="{{ route('admin.articles.edit', $article) }}" class="text-decoration-none">
                                    {{ Str::limit($article->title, 50) }}
                                </a>
                            </td>
                            <td>{{ $article->author->name }}</td>
                            <td>
                                <span class="badge bg-{{ $article->status == 'published' ? 'success' : 'warning' }}">
                                    {{ $article->status == 'published' ? 'Đã đăng' : 'Nháp' }}
                                </span>
                            </td>
                            <td>{{ $article->views }}</td>
                            <td>{{ $article->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Chưa có bài viết</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection