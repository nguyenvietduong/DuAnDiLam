<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the file (optional)
        $request->validate([
            'upload' => 'required|file|mimes:jpg,jpeg,png,gif|max:2048', // Adjust validation as needed
        ]);

        // Store the file in the storage (you can customize the disk here)
        if ($request->hasFile('upload')) {
            $path = $request->file('upload')->store('uploads', 'public');

            // Return the response expected by CKEditor
            return response()->json([
                'url' => Storage::url($path) // Returns the URL of the uploaded file
            ]);
        }

        return response()->json(['error' => 'File not uploaded'], 400);
    }
}
