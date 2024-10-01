<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Backend\PostDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\Services\PostServiceInterface;
use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Traits\HandleExceptionTrait;
use App\Interfaces\Repositories\AccountRepositoryInterface;
use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Interfaces\Repositories\TagRepositoryInterface;

// Requests
use App\Http\Requests\BackEnd\Posts\StoreRequest  as PostStoreRequest;
use App\Http\Requests\BackEnd\Posts\UpdateRequest as PostUpdateRequest;

use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use HandleExceptionTrait;

    protected $postService;
    protected $postRepository;
    protected $categoryRepository;
    protected $accountRepository;
    protected $tagRepository;

    // Base path for views
    const PATH_VIEW = 'backend.post.';

    public function __construct(
        PostServiceInterface            $postService,
        PostRepositoryInterface         $postRepository,
        CategoryRepositoryInterface     $categoryRepository,
        AccountRepositoryInterface      $accountRepository,
        TagRepositoryInterface          $tagRepository,
    ) {
        $this->postService          = $postService;
        $this->postRepository       = $postRepository;
        $this->categoryRepository   = $categoryRepository;
        $this->accountRepository    = $accountRepository;
        $this->tagRepository        = $tagRepository;
    }

    public function index(PostDataTable $dataTable)
    {
        forgetSessionImageTemp('image_temp');
        return $dataTable->render(self::PATH_VIEW . __FUNCTION__, [
            'tableName'     => 'post',
            'linkCreate'    => 'admin.post.create',
            'totalRecords'  => $this->postRepository->count(),
        ]);
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__, [
            'object'        => 'post',
            'categories'    => $this->categoryRepository->all(),
            'tags'          => $this->tagRepository->all(),
            'friends'       => $this->accountRepository->getFriendsByUserId(Auth::user()->id),
        ]);
    }

    /**
     * Handle the storage of a new post.
     *
     * @param PostStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostStoreRequest $request)
    {
        // Validate the data from the request using PostStoreRequest
        $data   = $request->validated();
        try {
            // Create a new post
            $this->postService->createPost($data);
            return redirect()->back()->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing an post.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Retrieve the details of the post
        $post = $this->postService->getPostDetail($id);
        if ($post) {
            return view(self::PATH_VIEW . __FUNCTION__, [
                'post'          => $post,
                'object'        => 'post',
                'categories'    => $this->categoryRepository->all(),
                'tags'          => $this->tagRepository->all(),
                'friends'       => $this->accountRepository->getFriendsByUserId(Auth::user()->id),
            ]);
        }

        abort(404);
    }

    /**
     * Handle the update of an post.
     *
     * @param int $id
     * @param PostUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, PostUpdateRequest $request)
    {
        // Validate the data from the request using PostUpdateRequest
        $data = $request->validated();

        try {
            // Update the post
            $this->postService->updatePost($id, $data);
            return redirect()->route('admin.post.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete an post.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Delete the post
            $this->postService->deletePost($id);
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
