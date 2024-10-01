<?php

namespace App\Http\Controllers\Backend;

use App\Models\System;
use App\Http\Controllers\Controller;
// use App\Repositories\Interfaces\SystemRepositoryInterface as SystemRepository;
use App\Repositories\SystemRepository;
use App\Services\Interfaces\SystemServiceInterface as SystemService;
use Illuminate\Http\Request;


class SystemController extends Controller
{
    protected $systemService;
    protected $systemRepository;

    public function __construct(
        SystemRepository $systemRepository,
        SystemService $systemService
    ) {
        $this->systemRepository = $systemRepository;
        $this->systemService = $systemService;
    }


    public function index()
    {
        $config['model'] = 'System';
        $config['seo'] = config('apps.messages.system');
        $systems = convert_array($this->systemRepository->all(), 'keyword', 'content');
        return view('backend.system.index', compact('config', 'systems'));
    }


    public function store(Request $request)
    {
        if ($this->systemService->save($request)) {
            return redirect()->route('system.index')->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->route('system.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại');

    }
}