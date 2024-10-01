<?php

namespace App\Interfaces\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface PostRepositoryInterface extends RepositoryInterface
{
    /**
     * Get post details by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getPostDetail(int $id);

    /**
     * Update an post by ID with new data.
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updatePost(int $id, array $params);

    /**
     * Create a new post with the provided data.
     *
     * @param array $params
     * @return mixed
     */
    public function createPost(array $params);

    /**
     * Get post details by ID. (May duplicate `getPostDetail` method)
     *
     * @param int $id
     * @return mixed
     */
    public function detailPost(int $id);

    /**
     * Delete an post by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deletePost(int $id);
}
