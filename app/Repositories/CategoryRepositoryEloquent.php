<?php

namespace App\Repositories;

use App\Models\Category;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\Repositories\CategoryRepositoryInterface;

class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * Specify the model class name.
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * Apply criteria in the current Query Repository.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get category details by ID.
     *
     * @param int $id
     * @return \App\Models\Category
     */
    public function getCategoryDetail($id)
    {
        return $this->find($id);
    }

    /**
     * Update an category by ID.
     *
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function updateCategory($id, $params)
    {
        return $this->update($params, $id);
    }

    /**
     * Create a new category.
     *
     * @param array $params
     * @return \App\Models\Category
     */
    public function createCategory($params)
    {
        return $this->create($params);
    }

    /**
     * Get category details by ID (same as getCategoryDetail).
     *
     * @param int $id
     * @return \App\Models\Category
     */
    public function detailCategory($id)
    {
        return $this->find($id);
    }

    /**
     * Delete an category by ID.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteCategory($id)
    {
        return $this->delete($id);
    }
}
