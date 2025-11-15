{{-- resources/views/admin/categories/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Quản lý chuyên mục')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-info mb-0">Chuyên mục</h4>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Thêm chuyên mục
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
                        <th>Tên</th>
                        <th>Slug</th>
                        <th>Chuyên mục cha</th>
                        <th>Bài viết</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $cat)
                    <tr>
                        <td>{{ $cat->id }}</td>
                        <td>
                            <strong>{{ $cat->name }}</strong>
                        </td>
                        <td><code>{{ $cat->slug }}</code></td>
                        <td>{{ $cat->parent?->name ?? '-' }}</td>
                        <td>
                            <span class="badge bg-info">{{ $cat->articles_count }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.categories.edit', $cat) }}"
                               class="btn btn-sm btn-warning text-white" title="Sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST"
                                  class="d-inline" onsubmit="return confirm('Xóa chuyên mục này?')">
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
                            Chưa có chuyên mục nào.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection