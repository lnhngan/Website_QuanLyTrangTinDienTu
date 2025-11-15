{{-- resources/views/admin/categories/edit.blade.php --}}
@extends('layouts.admin')
@section('title', 'Sửa chuyên mục')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-info mb-0">Sửa chuyên mục: {{ $category->name }}</h4>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf @method('PUT')
            @include('admin.categories._form')
        </form>
    </div>
</div>
@endsection