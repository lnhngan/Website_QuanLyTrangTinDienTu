{{-- resources/views/admin/articles/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Quản lý bài viết')

@section('content')
<!-- PHẦN TOP - ĐÃ SỬA HOÀN CHỈNH -->
<div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-white rounded shadow-sm border">
    <div class="d-flex align-items-center">
        <i class="fas fa-newspaper text-primary me-3" style="font-size: 1.8rem;"></i>
        <div>
            <h4 class="mb-0 text-info fw-bold">Quản lý bài viết</h4>
            <small class="text-muted">Tổng: <strong>{{ $articles->total() }}</strong> bài</small>
        </div>
    </div>
    <a href="{{ route('admin.articles.create') }}" class="btn btn-success btn-lg shadow-sm d-flex align-items-center">
        <i class="fas fa-plus me-2"></i>
        <span class="d-none d-sm-inline">Viết bài mới</span>
        <span class="d-inline d-sm-none">Thêm</span>
    </a>
</div>

<!-- ALERTS -->
@include('admin.partials.alerts')

<!-- BẢNG DANH SÁCH -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Tiêu đề</th>
                        <th>Tác giả</th>
                        <th>Chuyên mục</th>
                        <th>Trạng thái</th>
                        <th>Bình luận</th>
                        <th>Lượt xem</th>
                        <th class="text-center pe-4">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $i => $article)
                    <tr>
                        <td class="ps-4">{{ $articles->firstItem() + $i }}</td>
                        <td>
                            <a href="{{ route('admin.articles.show', $article) }}" class="text-decoration-none text-dark fw-medium">
                                {{ Str::limit($article->title, 50) }}
                            </a>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ $article->author->avatar ? asset('storage/'.$article->author->avatar) : 'https://via.placeholder.com/32' }}"
                                     class="rounded-circle me-2" width="32" height="32">
                                <span>{{ $article->author->name }}</span>
                            </div>
                        </td>
                        <td>{{ $article->category->name }}</td>
                        <td>
                            <span class="badge bg-{{ $article->status == 'published' ? 'success' : 'warning' }} px-3 py-2">
                                {{ $article->status == 'published' ? 'Đã đăng' : 'Nháp' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $article->comments_count }}</span>
                        </td>
                        <td>
                            <i class="fas fa-eye text-muted me-1"></i> {{ $article->views }}
                        </td>
                        <td class="text-center pe-4">
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.articles.edit', $article) }}" 
                                   class="btn btn-sm btn-warning text-white" title="Sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Xóa bài viết này?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Xóa">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="fas fa-file-alt fa-3x mb-3 text-muted"></i>
                            <p class="mb-0">Chưa có bài viết nào.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- resources/views/admin/articles/index.blade.php --}}
    <div class="card-footer bg-transparent border-0 py-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <small class="text-muted">
                    Hiển thị {{ $articles->firstItem() }} - {{ $articles->lastItem() }} 
                    trong tổng <strong>{{ $articles->total() }}</strong> bài viết
                </small>
            </div>
            <div>
                {{ $articles->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
@endpush