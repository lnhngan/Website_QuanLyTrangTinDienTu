@extends('layouts.admin')
@section('title', 'Đăng bài mới')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-info mb-0">Đăng bài viết mới</h4>
    <a href="{{ route('author.articles.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('author.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('author.articles._form')
        </form>
    </div>
</div>
@endsection