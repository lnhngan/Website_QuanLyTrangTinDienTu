<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('article');

        return [
            'title' => 'required|string|max:200',
            'slug' => [
                'required',
                'string',
                'max:200',
                'regex:/^[a-z0-9\-]+$/',
                Rule::unique('articles')->ignore($id),
            ],
            'category_id' => 'required|exists:categories,id',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'slug.unique' => 'Slug đã tồn tại.',
            'category_id.required' => 'Vui lòng chọn chuyên mục.',
            'content.required' => 'Nội dung không được để trống.',
            'thumbnail.image' => 'File phải là ảnh.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ];
    }
}