{{-- resources/views/admin/tags/edit.blade.php --}}
@extends('layouts.admin')
@section('title', 'Sửa Tag')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-info mb-0">Sửa Tag: {{ $tag->name }}</h4>
    <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
            @csrf @method('PUT')
            @include('admin.tags._form')
        </form>
    </div>
</div>
@endsection