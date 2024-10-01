<?php

namespace App\Http\Requests\Backend\Categories;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the Account is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Thay đổi này nếu cần kiểm tra quyền truy cập
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255',  // Title is required, max 255 characters
            'slug'      => 'required|string|max:255|unique:categories,slug',  // Slug is required, must be unique in the categories table
            'parent_id' => 'nullable|integer|exists:categories,id',  // If parent_id is provided, it must be an integer and exist in the categories table
        ];
    }
}
