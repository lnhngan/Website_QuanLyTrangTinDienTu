{{-- resources/views/admin/tags/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Quản lý Tag')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-info mb-0">Quản lý Tag</h4>
    <a href="{{ route('admin.tags.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Thêm Tag
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
                        <th>Tên Tag</th>
                        <th>Slug</th>
                        <th>Mô tả</th>
                        <th>Bài viết</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td><strong>{{ $tag->name }}</strong></td>
                        <td><code>{{ $tag->slug }}</code></td>
                        <td>{{ Str::limit($tag->description, 50) }}</td>
                        <td>
                            <span class="badge bg-info">{{ $tag->articles_count }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.tags.edit', $tag) }}"
                               class="btn btn-sm btn-warning text-white" title="Sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST"
                                  class="d-inline" onsubmit="return confirm('Xóa tag này?')">
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
                            Chưa có tag nào.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection