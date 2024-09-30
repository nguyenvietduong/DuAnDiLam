<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function setTheme(Request $request)
    {
        $request->validate([
            'theme' => 'required|in:light,dark',
        ]);
    
        session(['theme' => $request->input('theme')]); // Store theme in session
    
        return response()->json(['success' => true]);
    }    
}