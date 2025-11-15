{{-- resources/views/admin/tags/create.blade.php --}}
@extends('layouts.admin')
@section('title', 'Thêm Tag')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-info mb-0">Thêm Tag mới</h4>
    <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.tags.store') }}" method="POST">
            @csrf
            @include('admin.tags._form')
        </form>
    </div>
</div>
@endsection