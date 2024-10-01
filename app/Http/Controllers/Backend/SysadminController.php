<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SysadminController extends Controller
{
    public function index()
    {
        return view('sysadmin.dashboard'); // Ensure you have a corresponding view file
    }
}
