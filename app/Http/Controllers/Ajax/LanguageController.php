<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function setLanguage(Request $request)
    {
        // Validate the request
        $request->validate(['language' => 'required|string|in:en,vi']);

        // Store the language in the session
        session(['locale' => $request->language]);

        // Return a success response
        return response()->json(['success' => true]);
    }
}
