<?php

namespace App\Http\Requests\BackEnd\Categories;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the Account is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Thay đổi này nếu cần kiểm tra quyền truy cập
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * The validation rules for this request ensure that the 'name' field is
     * required and must be a string with a maximum length of 200 characters.
     * This is useful for validating the data when updating an item.
     *
     * @return array
     */
    public function rules(): array
    {
        $categoryId = $this->id; // Get the category ID from the route

        return [
            'name'         => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:categories,slug,' . $this->id,  // Ignore the slug of the current category,
            'parent_id'    => 'nullable|integer|exists:categories,id',
        ];
    }
}
