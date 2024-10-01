<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Backend\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\Services\CategoryServiceInterface;
use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Traits\HandleExceptionTrait;


// Requests
use App\Http\Requests\BackEnd\Categories\StoreRequest  as CategoryStoreRequest;
use App\Http\Requests\BackEnd\Categories\UpdateRequest as CategoryUpdateRequest;

class CategoryController extends Controller
{
    use HandleExceptionTrait;

    protected $categoryService;
    protected $categoryRepository;

    // Base path for views
    const PATH_VIEW = 'backend.category.';

    public function __construct(
        CategoryServiceInterface     $categoryService,
        CategoryRepositoryInterface  $categoryRepository,
    ) {
        $this->categoryService       = $categoryService;
        $this->categoryRepository    = $categoryRepository;
    }

    public function index(CategoryDataTable $dataTable)
    {
        forgetSessionImageTemp('image_temp');
        return $dataTable->render(self::PATH_VIEW . __FUNCTION__, [
            'tableName'     => 'category',
            'linkCreate'    => 'admin.category.create',
            'totalRecords'  => $this->categoryRepository->count(),
        ]);
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object'        => 'category',
            'categories'    => $this->categoryRepository->whereNull('parent_id')->with('children')->get(),
        ]);
    }

    /**
     * Handle the storage of a new category.
     *
     * @param CategoryStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryStoreRequest $request)
    {
        // Validate the data from the request using CategoryStoreRequest
        $data   = $request->validated();
        try {
            // Create a new category
            $this->categoryService->createCategory($data);
            return redirect()->back()->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing an category.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Retrieve the details of the category
        $category = $this->categoryService->getCategoryDetail($id);
        if ($category) {
            return view(self::PATH_VIEW . __FUNCTION__, [
                'category'      => $category,
                'object'        => 'category',
                'categories'    => $this->categoryRepository->whereNull('parent_id')->with('children')->get(),
            ]);
        }

        abort(404);
    }

    /**
     * Handle the update of an category.
     *
     * @param int $id
     * @param CategoryUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, CategoryUpdateRequest $request)
    {
        // Validate the data from the request using CategoryUpdateRequest
        $data = $request->validated();

        try {
            // Update the category
            $this->categoryService->updateCategory($id, $data);
            return redirect()->route('admin.category.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete an category.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Delete the category
            $this->categoryService->deleteCategory($id);
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
