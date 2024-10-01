<?php

namespace App\Http\Requests\Backend\Posts;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'         => 'required',
            'content'       => 'required',
            'categories'    => 'required|array|min:1',          // Ensure categories is an array with at least one element
            'categories.*'  => 'exists:categories,id',          // Each item in the categories array must exist in the categories table
            'friends'       => 'nullable|array',                // Make friends optional and validate as an array if present
            'friends.*'     => 'nullable|exists:users,id',      // Make each user_id optional and validate if present
            'status'        => 'required',
            'image'         => 'nullable|image',                // Make image optional but validate if present
            'tags'          => 'required|array',
            'tags.*'        => 'exists:tags,id',                // Validate that each tag exists in the tags table
        ];
    }

    
}
