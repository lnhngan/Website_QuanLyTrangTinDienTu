{{-- resources/views/admin/categories/_form.blade.php --}}
<div class="row">
    <div class="col-md-8 mb-3">
        <label class="form-label fw-bold">Tên chuyên mục <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $category->name ?? '') }}" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label fw-bold">Slug <span class="text-danger">*</span></label>
        <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror"
               value="{{ old('slug', $category->slug ?? '') }}" required>
        @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <small class="text-muted">Tự động sinh nếu để trống</small>
    </div>
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Mô tả</label>
    <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Chuyên mục cha</label>
    <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
        <option value="">-- Không có --</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}"
                {{ old('parent_id', $category->parent_id ?? '') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
    @error('parent_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="d-flex justify-content-end gap-2">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> {{ isset($category) ? 'Cập nhật' : 'Thêm mới' }}
    </button>
</div>

@push('scripts')
<script>
    document.querySelector('[name="name"]').addEventListener('input', function() {
        const slug = this.value.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim();
        document.getElementById('slug').value = slug;
    });
</script>
@endpush