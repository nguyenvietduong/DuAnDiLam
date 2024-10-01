<?php

namespace App\Http\Requests\Backend\Accounts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage; // Thêm dòng này ở đầu file nếu chưa có

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
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users,email',
            'password'      => 'required|string|min:6',
            're_password'   => 'required|string|min:6|same:password',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone'         => 'nullable|digits_between:10,11|numeric|unique:users,phone',
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
