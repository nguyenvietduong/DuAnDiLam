<?php

namespace App\Repositories;

use App\Models\Post;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\Repositories\PostRepositoryInterface;

class PostRepositoryEloquent extends BaseRepository implements PostRepositoryInterface
{
    /**
     * Specify the model class name.
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
    }

    /**
     * Apply criteria in the current Query Repository.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get post details by ID.
     *
     * @param int $id
     * @return \App\Models\Post
     */
    public function getPostDetail($id)
    {
        return $this->find($id);
    }

    /**
     * Update an post by ID.
     *
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function updatePost($id, $params)
    {
        return $this->update($params, $id);
    }

    /**
     * Create a new post.
     *
     * @param array $params
     * @return \App\Models\Post
     */
    public function createPost($params)
    {
        return $this->create($params);
    }

    /**
     * Get post details by ID (same as getPostDetail).
     *
     * @param int $id
     * @return \App\Models\Post
     */
    public function detailPost($id)
    {
        return $this->find($id);
    }

    /**
     * Delete an post by ID.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deletePost($id)
    {
        return $this->delete($id);
    }
}
