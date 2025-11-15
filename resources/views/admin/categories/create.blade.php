{{-- resources/views/admin/categories/create.blade.php --}}
@extends('layouts.admin')
@section('title', 'Thêm chuyên mục')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-info mb-0">Thêm chuyên mục mới</h4>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            @include('admin.categories._form')
        </form>
    </div>
</div>
@endsection