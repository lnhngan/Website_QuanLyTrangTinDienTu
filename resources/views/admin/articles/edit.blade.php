{{-- resources/views/admin/articles/edit.blade.php --}}
@extends('layouts.admin')
@section('title', 'Sửa bài viết')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-info mb-0">Sửa: {{ $article->title }}</h4>
    <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.articles._form')
        </form>
    </div>
</div>
@endsection