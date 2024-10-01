<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Repositories\Interfaces\EditorRepositoryInterface as EditorRepository;
use App\Services\Interfaces\EditorServiceInterface as EditorService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    protected $editorService;
    protected $editorRepository;
    protected $provinceRepository;

    public function __construct(
        EditorRepository $editorRepository,
        EditorService $editorService,
        ProvinceRepository $provinceRepository,
    ) {
        $this->editorRepository = $editorRepository;
        $this->editorService = $editorService;
        $this->provinceRepository = $provinceRepository;
    }

    public function index(Request $request)
    {
        $editers = $this->editorService->paginate($request);
        $config['model'] = 'Editor';
        $config['seo'] = config('apps.messages.editor');

        // dd($config);
        return view('backend.user.editor.index', compact('config', 'editers'));
    }

    public function create()
    {
        $config['model'] = 'Editor';
        $config['seo'] = config('apps.messages.editor');
        $provinces = $this->provinceRepository->all();

        return view('backend.user.editor.create', compact('config', 'provinces'));
    }

    public function store(StoreUserRequest $request)
    {
        if ($this->editorService->create($request)) {
            return redirect()->route('editor.index')->with('success', 'Thêm mới thành công.');
        }
        return redirect()->route('editor.index')->with('error', 'Thêm mới không thành công. Vui lòng thử lại');
    }

    public function edit($id)
    {
        $provinces = $this->provinceRepository->all();
        $editor = $this->editorRepository->findById($id);
        $config['seo'] = config('apps.messages.editor');
        $config['model'] = 'editor';

        return view('backend.user.editor.update', compact('config', 'editor', 'provinces'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        if ($this->editorService->update($id, $request)) {
            return redirect()->route('editor.index')->with('success', 'Sửa thành công.');
        }
        return redirect()->route('editor.index')->with('error', 'Sửa không thành công. Vui lòng thử lại');
    }

    public function delete($id)
    {
        // $this->authorize('modules', 'user.delete');
        $config['seo'] = config('apps.messages.editor');
        $editor = $this->editorRepository->findById($id);
        return view('backend.user.editor.delete', compact('editor', 'config'));
    }

    public function destroy($id)
    {

        if ($this->editorService->destroy($id)) {
            return redirect()->route('editor.index')->with('success', 'Xóa thành công.');
        }
        return redirect()->route('editor.index')->with('error', 'Xóa không thành công. Vui lòng thử lại');
    }
}

