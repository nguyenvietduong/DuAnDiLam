<?php

namespace App\Interfaces\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    /**
     * Get category details by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getCategoryDetail(int $id);

    /**
     * Update an category by ID with new data.
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updateCategory(int $id, array $params);

    /**
     * Create a new category with the provided data.
     *
     * @param array $params
     * @return mixed
     */
    public function createCategory(array $params);

    /**
     * Get category details by ID. (May duplicate `getCategoryDetail` method)
     *
     * @param int $id
     * @return mixed
     */
    public function detailCategory(int $id);

    /**
     * Delete an category by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteCategory(int $id);
}
