{{-- resources/views/admin/articles/_form.blade.php --}}
<div class="row mb-3">
    <div class="col-md-8">
        <label class="form-label fw-bold">Tiêu đề <span class="text-danger">*</span></label>
        <input type="text" name="title" id="title" class="form-control form-control-lg @error('title') is-invalid @enderror"
               value="{{ old('title', isset($article) ? $article->title : '') }}" required>
        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label fw-bold">Slug <span class="text-danger">*</span></label>
        <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror"
               value="{{ old('slug', isset($article) ? $article->slug : '') }}" required>
        @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <small class="text-muted">Tự động sinh nếu để trống</small>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label fw-bold">Chuyên mục <span class="text-danger">*</span></label>
        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
            <option value="">-- Chọn chuyên mục --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" 
                    {{ old('category_id', isset($article) ? $article->category_id : '') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Trạng thái <span class="text-danger">*</span></label>
        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
            <option value="draft" {{ old('status', isset($article) ? $article->status : 'draft') == 'draft' ? 'selected' : '' }}>Nháp</option>
            <option value="published" {{ old('status', isset($article) ? $article->status : '') == 'published' ? 'selected' : '' }}>Xuất bản</option>
            <option value="archived" {{ old('status', isset($article) ? $article->status : '') == 'archived' ? 'selected' : '' }}>Lưu trữ</option>
        </select>
    </div>
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Tóm tắt</label>
    <textarea name="summary" rows="3" class="form-control @error('summary') is-invalid @enderror">{{ old('summary', isset($article) ? $article->summary : '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Nội dung <span class="text-danger">*</span></label>
    <textarea name="content" id="content-editor" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', isset($article) ? $article->content : '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Ảnh đại diện</label>
    <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
    @if(isset($article) && $article->thumbnail)
        <img src="{{ asset('storage/' . $article->thumbnail) }}" class="mt-2 img-thumbnail" style="max-height: 100px;">
    @endif
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Thẻ (tags)</label>
    <select name="tags[]" class="form-select @error('tags') is-invalid @enderror" multiple>
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}"
                {{ collect(old('tags', isset($article) ? $article->tags->pluck('id')->toArray() : []))->contains($tag->id) ? 'selected' : '' }}>
                {{ $tag->name }}
            </option>
        @endforeach
    </select>
    <small class="text-muted">Giữ <kbd>Ctrl</kbd> để chọn nhiều</small>
</div>

<div class="d-flex justify-content-end gap-2">
    <button type="submit" class="btn btn-primary btn-lg">
        <i class="fas fa-save"></i> {{ isset($article) ? 'Cập nhật' : 'Đăng bài' }}
    </button>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/43.2.0/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script>
    ClassicEditor.create(document.querySelector('#content-editor'), {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote']
    });

    $('select[name="tags[]"]').select2({
        theme: 'bootstrap-5',
        placeholder: 'Chọn thẻ...'
    });

    $('#title').on('input', function() {
        const slug = this.value.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim();
        $('#slug').val(slug);
    });
</script>
@endpush