<?php

namespace App\Repositories;

use App\Models\Tag;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\Repositories\TagRepositoryInterface;

class TagRepositoryEloquent extends BaseRepository implements TagRepositoryInterface
{
    /**
     * Specify the model class name.
     *
     * @return string
     */
    public function model()
    {
        return Tag::class;
    }

    /**
     * Apply criteria in the current Query Repository.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get tag details by ID.
     *
     * @param int $id
     * @return \App\Models\Tag
     */
    public function getTagDetail($id)
    {
        return $this->find($id);
    }

    /**
     * Update an tag by ID.
     *
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function updateTag($id, $params)
    {
        return $this->update($params, $id);
    }

    /**
     * Create a new tag.
     *
     * @param array $params
     * @return \App\Models\Tag
     */
    public function createTag($params)
    {
        return $this->create($params);
    }

    /**
     * Get tag details by ID (same as getTagDetail).
     *
     * @param int $id
     * @return \App\Models\Tag
     */
    public function detailTag($id)
    {
        return $this->find($id);
    }

    /**
     * Delete an tag by ID.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteTag($id)
    {
        return $this->delete($id);
    }
}
