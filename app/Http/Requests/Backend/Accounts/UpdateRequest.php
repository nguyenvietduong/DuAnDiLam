<?php

namespace App\Http\Requests\BackEnd\Accounts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage; // Thêm dòng này ở đầu file nếu chưa có

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
    public function rules()
    {
        return [
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users,email,' . $this->id,
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'full'          => 'nullable|string|max:255',
            'phone'         => 'nullable|digits_between:10,11|numeric',
            'address'       => 'nullable|string',
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
