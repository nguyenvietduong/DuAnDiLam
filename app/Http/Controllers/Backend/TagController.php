<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Backend\TagDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\Services\TagServiceInterface;
use App\Interfaces\Repositories\TagRepositoryInterface;
use App\Traits\HandleExceptionTrait;

// Requests
use App\Http\Requests\BackEnd\Tags\StoreRequest  as TagStoreRequest;
use App\Http\Requests\BackEnd\Tags\UpdateRequest as TagUpdateRequest;

class TagController extends Controller
{
    use HandleExceptionTrait;

    protected $tagService;
    protected $tagRepository;

    // Base path for views
    const PATH_VIEW = 'backend.tag.';

    public function __construct(
        TagServiceInterface     $tagService,
        TagRepositoryInterface  $tagRepository,
    ) {
        $this->tagService       = $tagService;
        $this->tagRepository    = $tagRepository;
    }

    public function index(TagDataTable $dataTable)
    {
        forgetSessionImageTemp('image_temp');
        return $dataTable->render(self::PATH_VIEW . __FUNCTION__, [
            'tableName'     => 'tag',
            'linkCreate'    => 'admin.tag.create',
            'totalRecords'  => $this->tagRepository->count(),
        ]);
    }

    /**
     * Show the form for creating a new tag.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object'        => 'tag',
        ]);
    }

    /**
     * Handle the storage of a new tag.
     *
     * @param TagStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TagStoreRequest $request)
    {
        // Validate the data from the request using TagStoreRequest
        $data   = $request->validated();
        try {
            // Create a new tag
            $this->tagService->createTag($data);
            return redirect()->back()->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing an tag.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Retrieve the details of the tag
        $tag = $this->tagService->getTagDetail($id);
        if ($tag) {
            return view(self::PATH_VIEW . __FUNCTION__, [
                'tag'       => $tag,
                'object'    => 'tag',
            ]);
        }

        abort(404);
    }

    /**
     * Handle the update of an tag.
     *
     * @param int $id
     * @param TagUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, TagUpdateRequest $request)
    {
        // Validate the data from the request using TagUpdateRequest
        $data = $request->validated();

        try {
            // Update the tag
            $this->tagService->updateTag($id, $data);
            return redirect()->route('admin.tag.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete an tag.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Delete the tag
            $this->tagService->deleteTag($id);
            // Trả về JSON response nếu thành công
            return response()->json([
                'success' => true,
                'message' => 'User delete successfully!',
            ]);
        } catch (\Exception $e) {
            // Trả về JSON response nếu có lỗi
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
