<?php

namespace App\Interfaces\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface TagRepositoryInterface extends RepositoryInterface
{
    /**
     * Get tag details by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getTagDetail(int $id);

    /**
     * Update an tag by ID with new data.
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updateTag(int $id, array $params);

    /**
     * Create a new tag with the provided data.
     *
     * @param array $params
     * @return mixed
     */
    public function createTag(array $params);

    /**
     * Get tag details by ID. (May duplicate `getTagDetail` method)
     *
     * @param int $id
     * @return mixed
     */
    public function detailTag(int $id);

    /**
     * Delete an tag by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteTag(int $id);
}
