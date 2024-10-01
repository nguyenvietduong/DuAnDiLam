<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Comment\UpdateCommentRequest;
use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface  as CommentRepository;
use App\Services\Interfaces\CommentServiceInterface         as CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Declare the comment repository and service for handling comment-related logic.
    protected $commentRepository;
    protected $commentService;

    // Constructor to initialize CommentRepository and CommentService.
    public function __construct(
        CommentRepository $commentRepository, // Repository for managing data-related operations for comments.
        CommentService $commentService        // Service for handling business logic related to comments.
    ) {
        $this->commentRepository = $commentRepository;
        $this->commentService = $commentService;
    }

    // Method to display a list of comments with pagination.
    public function index(Request $request)
    {
        // Set up configuration data for the view.
        $config['model']    = 'Comment';  // Define the model as 'Comment'.
        $config['seo']      = config('apps.messages.comment');  // Load SEO-related configuration for comments.

        // Fetch paginated comments using the service layer.
        $comments = $this->commentService->paginate($request);

        // Return the view to display comments along with the config and comment data.
        return view('backend.comment.index', compact('config', 'comments'));
    }

    // Method to display the form for editing a comment.
    public function edit($id)
    {
        // Set up configuration data for the view.
        $config['model']    = 'Comment';  // Define the model as 'Comment'.
        $config['seo']      = config('apps.messages.comment');  // Load SEO-related configuration for comments.

        // Find the comment by its ID using the repository.
        $comment = $this->commentRepository->findById($id);

        // Return the view for editing a comment along with the comment and config data.
        return view('backend.comment.edit', compact('comment', 'config'));
    }

    // Method to update a comment in the database.
    public function update(UpdateCommentRequest $request, $id)
    {
        // Use the service layer to handle comment update. Return success or error message depending on the result.
        if ($this->commentService->update($id, $request)) {
            return redirect()->route('admin.comment.index')->with('success', 'Record updated successfully');
        }

        return redirect()->route('admin.comment.index')->with('error', 'Failed to update record. Please try again');
    }

    // Method to delete a comment from the database.
    public function destroy($id)
    {
        // Use the service layer to handle comment deletion. Return success or error message depending on the result.
        if ($this->commentService->destroy($id)) {
            return redirect()->route('admin.comment.index')->with('success', 'Record deleted successfully');
        }

        return redirect()->route('admin.comment.index')->with('error', 'Failed to delete record. Please try again');
    }

    // Method to update the status of a comment (e.g., approve or disapprove).
    public function updateStatus(Request $request, $id)
    {
        // Find the comment by its ID. Return a 404 error if the comment is not found.
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        // Update the status of the comment and save it.
        $comment->status = $request->status;
        $comment->save();

        // Return a success message after updating the status.
        return response()->json(['message' => 'Status updated successfully']);
    }
}
