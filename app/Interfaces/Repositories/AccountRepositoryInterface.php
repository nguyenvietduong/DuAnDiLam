<?php

namespace App\Interfaces\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface AccountRepositoryInterface extends RepositoryInterface
{
    /**
     * Count users with the role 'user'.
     *
     * @return int
     */
    public function countWithAccount($role);

    /**
     * Get account friends by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getFriendsByUserId(int $id);

    /**
     * Get account details by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getAccountDetail(int $id);

    /**
     * Update an account by ID with new data.
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updateAccount(int $id, array $params);

    /**
     * Create a new account with the provided data.
     *
     * @param array $params
     * @return mixed
     */
    public function createAccount(array $params);

    /**
     * Get account details by ID. (May duplicate `getAccountDetail` method)
     *
     * @param int $id
     * @return mixed
     */
    public function detailAccount(int $id);

    /**
     * Delete an account by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteAccount(int $id);
}
