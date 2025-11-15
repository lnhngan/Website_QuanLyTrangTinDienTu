<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép tất cả admin
    }

    public function rules(): array
    {
        $id = $this->route('category');

        return [
            'name' => 'required|string|max:100',
            'slug' => [
                'required',
                'string',
                'max:150',
                'regex:/^[a-z0-9\-]+$/',
                Rule::unique('categories')->ignore($id),
            ],
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên chuyên mục.',
            'slug.required' => 'Slug là bắt buộc.',
            'slug.unique' => 'Slug đã tồn tại.',
            'slug.regex' => 'Slug chỉ chứa chữ thường, số và dấu gạch ngang.',
            'parent_id.exists' => 'Chuyên mục cha không hợp lệ.',
        ];
    }
}
