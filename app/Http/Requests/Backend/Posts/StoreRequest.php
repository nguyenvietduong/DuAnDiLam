<?php

namespace App\Http\Requests\Backend\Posts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage; // Thêm dòng này ở đầu file nếu chưa có

class StoreRequest extends FormRequest
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
            'categories'    => 'required',
            'friends'       => 'nullable|array', // Make friends optional and validate as an array if present
            'friends.*'     => 'nullable|exists:users,id', // Make each user_id optional and validate if present
            'status'        => 'required',
            'image'         => 'required|image',
            'tags'          => 'required|array',
            'tags.*'        => 'required|exists:tags,id', // Validate that each tag exists in the tags table
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Check if an image was uploaded
        if ($this->hasFile('image')) {
            $image = $this->file('image');

            // Ensure the admin is authenticated
            if (Auth::check()) {
                $adminId = Auth::user()->id; // Get the authenticated admin ID

                // Generate a unique file name
                $fileName  = $this->generateUniqueFileName($image);

                // Define the directory path
                $directory = "temp_images/{$adminId}";
                $filePath  = "{$directory}/{$fileName}";

                // Store the file in the temp_images folder
                Storage::put($filePath, file_get_contents($image->getRealPath()));

                // Save the file path in session
                session(['image_temp' => $filePath]);
            }
        }

        // Redirect back with validation errors and input
        throw new HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()
        );
    }

    private function generateUniqueFileName(UploadedFile $file): string
    {
        $timestamp = time();
        $extension = $file->getClientOriginalExtension();
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        return "{$fileName}_{$timestamp}.{$extension}";
    }
}
