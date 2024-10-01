<?php

namespace App\Services;

use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Interfaces\Services\PostServiceInterface;
use App\Interfaces\Services\ImageServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Support\Facades\Auth;

class PostService extends BaseService implements PostServiceInterface
{
    protected $postRepository;
    protected $imageService;

    /**
     * Tạo mới instance của PostService.
     *
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(
        PostRepositoryInterface     $postRepository,
        ImageServiceInterface       $imageService
    ) {
        $this->postRepository   = $postRepository;
        $this->imageService     = $imageService;
    }
    /**
     * Lấy chi tiết của post theo ID.
     *
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getPostDetail(int $id)
    {
        try {
            return $this->postRepository->getPostDetail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Post không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể lấy chi tiết post: ' . $e->getMessage());
        }
    }

    /**
     * Tạo mới một post.
     *
     * @param array $data
     * @return mixed
     */

    public function createPost(array $data)
    {
        try {
            // Set the current user ID
            $data['user_id'] = Auth::id();

            $image = null;

            // Handle image upload from request
            if (isset($data['image'])) {
                // Use ImageService to store image in S3
                $data['image'] = $this->imageService->storeImageS3('post_files', $data['image']);
            } elseif (session('image_temp')) {
                // If a temporary image is stored in session
                $tempImageName = session('image_temp');
                $tempImagePath = $tempImageName; // Path of the temporary image in local storage

                // Check if the temporary image exists
                if (Storage::exists($tempImagePath)) {
                    // Full path of the file in local storage
                    $fullTempImagePath = Storage::path($tempImagePath);

                    // Create an UploadedFile object from the saved file in storage
                    $image = new UploadedFile(
                        $fullTempImagePath,       // Full path to the file
                        $tempImageName,           // Original file name
                        null,                     // Mime type (Laravel will auto-determine if null)
                        null,                     // File size
                        true                      // Mark the file as "already moved"
                    );

                    // Store the image in S3
                    $data['image'] = $this->imageService->storeImageS3('post_files', $image);

                    // Delete the temporary image after successful upload to S3
                    $this->imageService->deleteImage($tempImagePath);
                } else {
                    throw new \Exception('Temporary file does not exist in local storage.');
                }
            }

            // Remove unnecessary fields from $data array before creating the post
            $tags = $data['tags'] ?? null;
            $categories = $data['categories'] ?? null;
            $mentions = $data['mentions'] ?? null;

            unset($data['tags'], $data['categories'], $data['mentions']);

            // Create the post using the repository
            $post = $this->postRepository->createPost($data);

            // Update pivot relationships (tags, categories, mentions) if the post is successfully created
            if ($post) {
                // Sync categories if provided
                if ($categories) {
                    $this->postRepository->updatePivot($post, $categories, 'categories');
                }

                // Sync mentions if provided
                if ($mentions) {
                    $this->postRepository->updatePivot($post, $mentions, 'mentions');
                }

                // Sync tags if provided
                if ($tags) {
                    $this->postRepository->updatePivot($post, $tags, 'tags');
                }
            }
        } catch (\Exception $e) {
            throw new \Exception('Unable to create post: ' . $e->getMessage());
        }
    }

    /**
     * Cập nhật một post theo ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updatePost(int $id, array $data)
    {
        try {
            // Set the current user ID
            $data['user_id'] = Auth::id();

            // Fetch the post details
            $post = $this->postRepository->getPostDetail($id);

            if (!$post) {
                throw new ModelNotFoundException("Post with ID: {$id} not found.");
            }

            $oldImagePath = $post->image;
            $image = null;

            // Handle image update
            if (isset($data['image'])) {
                // Update the image in S3 and delete the old image if needed
                $data['image'] = $this->imageService->updateImageS3('post_files', $data['image'], $oldImagePath);
            } elseif (session('image_temp')) {
                // If a temporary image is stored in session
                $tempImageName = session('image_temp');
                $tempImagePath = $tempImageName;

                // Check if the temporary image exists
                if (Storage::exists($tempImagePath)) {
                    // Full path of the file in local storage
                    $fullTempImagePath = Storage::path($tempImagePath);

                    // Create an UploadedFile object from the saved file in storage
                    $image = new UploadedFile(
                        $fullTempImagePath,       // Full path to the file
                        $tempImageName,           // Original file name
                        null,                     // Mime type (Laravel will auto-determine if null)
                        null,                     // File size
                        true                      // Mark the file as "already moved"
                    );

                    // Update the image in S3 and delete the old image if needed
                    $data['image'] = $this->imageService->updateImageS3('post_files', $image, $oldImagePath);

                    // Delete the temporary image after successful upload to S3
                    $this->imageService->deleteImage($tempImagePath);
                } else {
                    throw new \Exception('Temporary file does not exist in local storage.');
                }
            }


            // Remove unnecessary fields from $data array
            $tags = $data['tags'] ?? null;
            $categories = $data['categories'] ?? null;
            $mentions = $data['mentions'] ?? null;

            unset($data['tags'], $data['categories'], $data['mentions']);

            // Update the post
            $updatedPost = $this->postRepository->updatePost($id, $data);

            // Update pivot relationships (tags, categories, mentions)
            if ($updatedPost) {
                // Sync categories if provided
                if ($categories) {
                    $this->postRepository->updatePivot($updatedPost, $categories, 'categories');
                }

                // Sync mentions if provided
                if ($mentions) {
                    $this->postRepository->updatePivot($updatedPost, $mentions, 'mentions');
                }

                // Sync tags if provided
                if ($tags) {
                    $this->postRepository->updatePivot($updatedPost, $tags, 'tags');
                }
            }

            return $updatedPost;
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("Post with ID: {$id} not found.");
        } catch (\Exception $e) {
            throw new \Exception('Unable to update post: ' . $e->getMessage());
        }
    }

    /**
     * Xóa một post theo ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function deletePost(int $id)
    {
        try {
            return $this->postRepository->deletePost($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Post không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể xóa post: ' . $e->getMessage());
        }
    }
}
