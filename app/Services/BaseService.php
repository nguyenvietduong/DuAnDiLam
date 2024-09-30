<?php

namespace App\Services;

use Prettus\Repository\Contracts\RepositoryInterface;

class BaseService
{
    // Fields to specify the columns to be selected when querying
    protected $showField = ['*'];

    // Default number of records per page for pagination
    protected $perPage = 15;

    /**
     * @var RepositoryInterface
     * Represents the repository class linked with this service.
     */
    protected $repository;

    /**
     * Set default display columns if no specific columns are provided.
     *
     * @param array|null $columns
     */
    private function setShowField(&$columns)
    {
        if ($columns === null) {
            $columns = $this->showField;
        }
    }

    /**
     * Get all records from the repository with the specified columns.
     *
     * @param array|null $columns
     * @return mixed
     */
    public function all($columns = null)
    {
        $this->setShowField($columns);
        return $this->repository->all($columns);
    }

    /**
     * Get the first record from the repository with the specified columns.
     *
     * @param array|null $columns
     * @return mixed
     */
    public function first($columns = null)
    {
        $this->setShowField($columns);
        return $this->repository->first($columns);
    }

    /**
     * Paginate records from the repository with the specified columns.
     *
     * @param int|null $limit
     * @param array|null $columns
     * @return mixed
     */
    public function paginate($limit = null, $columns = null)
    {
        $this->setShowField($columns);
        $limit = $limit ?? $this->perPage;
        return $this->repository->paginate($limit, $columns);
    }

    /**
     * Find a record by ID from the repository with the specified columns.
     *
     * @param int $id
     * @param array|null $columns
     * @return mixed
     */
    public function find($id, $columns = null)
    {
        $this->setShowField($columns);
        return $this->repository->find($id, $columns);
    }

    /**
     * Find records by the value of a specific field from the repository with the specified columns.
     *
     * @param string $field
     * @param mixed $value
     * @param array|null $columns
     * @return mixed
     */
    public function findByField($field, $value, $columns = null)
    {
        $this->setShowField($columns);
        return $this->repository->findByField($field, $value, $columns);
    }

    /**
     * Find records by the specified conditions from the repository with the specified columns.
     *
     * @param array $where
     * @param array|null $columns
     * @return mixed
     */
    public function findWhere(array $where, $columns = null)
    {
        $this->setShowField($columns);
        return $this->repository->findWhere($where, $columns);
    }

    /**
     * Find records with a field value in a list of values from the repository with the specified columns.
     *
     * @param string $field
     * @param array $where
     * @param array|null $columns
     * @return mixed
     */
    public function findWhereIn($field, array $where, $columns = null)
    {
        $this->setShowField($columns);
        return $this->repository->findWhereIn($field, $where, $columns);
    }

    /**
     * Find records with a field value not in a list of values from the repository with the specified columns.
     *
     * @param string $field
     * @param array $where
     * @param array|null $columns
     * @return mixed
     */
    public function findWhereNotIn($field, array $where, $columns = null)
    {
        $this->setShowField($columns);
        return $this->repository->findWhereNotIn($field, $where, $columns);
    }

    /**
     * Find records with a field value within a range of values from the repository with the specified columns.
     *
     * @param string $field
     * @param array $where
     * @param array|null $columns
     * @return mixed
     */
    public function findWhereBetween($field, array $where, $columns = null)
    {
        $this->setShowField($columns);
        return $this->repository->findWhereBetween($field, $where, $columns);
    }

    /**
     * Create a new record in the repository with the specified attributes.
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->repository->create($attributes);
    }

    /**
     * Update the record with the specified ID in the repository with the new attributes.
     *
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        return $this->repository->update($attributes, $id);
    }

    /**
     * Update or create a record based on the specified attributes and values.
     *
     * @param array $attributes
     * @param array $values
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->repository->updateOrCreate($attributes, $values);
    }

    /**
     * Delete the record with the specified ID from the repository.
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * Delete records from the repository based on the specified conditions.
     *
     * @param array $where
     * @return mixed
     */
    public function deleteWhere(array $where)
    {
        return $this->repository->deleteWhere($where);
    }

    /**
     * Sort records by the specified column and sort direction.
     *
     * @param string $column
     * @param string $direction
     * @return mixed
     */
    public function orderBy($column, $direction = 'asc')
    {
        return $this->repository->orderBy($column, $direction);
    }

    /**
     * Attach relationships from the repository to load related data.
     *
     * @param array $relations
     * @return mixed
     */
    public function with(array $relations)
    {
        return $this->repository->with($relations);
    }
}
