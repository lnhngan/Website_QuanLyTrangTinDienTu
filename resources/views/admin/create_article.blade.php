{{-- resources/views/admin/articles/create.blade.php --}}
@extends('layouts.admin') {{-- DÙNG LAYOUT ADMIN --}}

@section('title', 'Tạo bài viết mới')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-info mb-0">Tạo bài viết mới</h4>
    <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Tiêu đề & Slug -->
            <div class="row mb-3">
                <div class="col-md-8">
                    <label class="form-label fw-bold">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control form-control-lg @error('title') is-invalid @enderror"
                           value="{{ old('title') }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Slug <span class="text-danger">*</span></label>
                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror"
                           value="{{ old('slug') }}" required>
                    @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-muted">Tự động sinh nếu để trống</small>
                </div>
            </div>

            <!-- Chuyên mục & Tác giả -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Chuyên mục <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                        <option value="">-- Chọn chuyên mục --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Tác giả</label>
                    <select name="author_id" class="form-select @error('author_id') is-invalid @enderror">
                        <option value="">-- Chọn tác giả --</option>
                        @foreach($authors as $user)
                            <option value="{{ $user->id }}" {{ old('author_id', auth()->id()) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->role }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Tóm tắt -->
            <div class="mb-3">
                <label class="form-label fw-bold">Tóm tắt</label>
                <textarea name="summary" rows="3" class="form-control @error('summary') is-invalid @enderror">{{ old('summary') }}</textarea>
                @error('summary') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Nội dung -->
            <div class="mb-3">
                <label class="form-label fw-bold">Nội dung <span class="text-danger">*</span></label>
                <textarea name="content" id="content-editor" class="form-control @error('content') is-invalid @enderror" rows="10" required>{{ old('content') }}</textarea>
                @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Thumbnail -->
            <div class="mb-3">
                <label class="form-label fw-bold">Ảnh đại diện</label>
                <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
                @error('thumbnail') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <small class="text-muted">JPG, PNG. Tối đa 2MB.</small>
            </div>

            <!-- Thẻ (Tags) -->
            <div class="mb-3">
                <label class="form-label fw-bold">Thẻ (tags)</label>
                <select name="tags[]" class="form-select @error('tags') is-invalid @enderror" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                @error('tags') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <small class="text-muted">Giữ <kbd>Ctrl</kbd> để chọn nhiều</small>
            </div>

            <!-- Trạng thái -->
            <div class="mb-3">
                <label class="form-label fw-bold">Trạng thái <span class="text-danger">*</span></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Nháp</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Xuất bản</option>
                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Lưu trữ</option>
                </select>
            </div>

            <!-- Nút lưu -->
            <div class="d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Lưu bài viết
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/43.2.0/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // CKEditor
    ClassicEditor
        .create(document.querySelector('#content-editor'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable']
        })
        .catch(error => console.error(error));

    // Select2 cho tags
    $('select[name="tags[]"]').select2({
        theme: 'bootstrap-5',
        placeholder: 'Chọn thẻ...',
        allowClear: true
    });

    // Tự động sinh slug
    $('#title').on('input', function() {
        let slug = this.value
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim();
        $('#slug').val(slug);
    });
</script>
@endpush