<div class="mb-3">
    <label class="form-label fw-bold">Tiêu đề <span class="text-danger">*</span></label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $article->title ?? '') }}" required>
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Chuyên mục <span class="text-danger">*</span></label>
    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
        <option value="">-- Chọn chuyên mục --</option>
        @foreach(\App\Models\Category::all() as $cat)
            <option value="{{ $cat->id }}" {{ old('category_id', $article->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Nội dung <span class="text-danger">*</span></label>
    <textarea name="content" rows="10" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $article->content ?? '') }}</textarea>
    @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Thumbnail</label>
    <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
    @error('thumbnail') <div class="invalid-feedback">{{ $message }}</div> @enderror
    @if(isset($article) && $article->thumbnail)
        <img src="{{ asset('storage/' . $article->thumbnail) }}" class="mt-2 rounded" width="200">
    @endif
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Trạng thái</label>
    <select name="status" class="form-select">
        <option value="draft" {{ old('status', $article->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Bản nháp</option>
        <option value="published" {{ old('status', $article->status ?? '') === 'published' ? 'selected' : '' }}>Đã đăng</option>
    </select>
</div>

<div class="d-flex justify-content-end gap-2">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> {{ isset($article) ? 'Cập nhật' : 'Đăng bài' }}
    </button>
</div>