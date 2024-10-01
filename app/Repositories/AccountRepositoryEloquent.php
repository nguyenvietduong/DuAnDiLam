<?php

namespace App\Repositories;

use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Interfaces\Repositories\AccountRepositoryInterface;

class AccountRepositoryEloquent extends BaseRepository implements AccountRepositoryInterface
{
    /**
     * Specify the model class name.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Apply criteria in the current Query Repository.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Count users with the role 'user'.
     *
     * @return int
     */
    public function countWithAccount($role)
    {
        // Assuming role '1' represents users
        return $this->where('role', $role)->count();
    }

    /**
     * Get account friends by ID.
     *
     * @param int $id
     * @return \App\Models\Account
     */
    public function getFriendsByUserId($id)
    {
        $user = $this->find($id);
        if (!$user) {
            return collect(); // Hoặc tùy chọn khác nếu không tìm thấy người dùng
        }

        return $user->friends; // Trả về danh sách bạn bè của người dùng
    }

    /**
     * Get account details by ID.
     *
     * @param int $id
     * @return \App\Models\Account
     */
    public function getAccountDetail($id)
    {
        return $this->find($id);
    }

    /**
     * Update an account by ID.
     *
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function updateAccount($id, $params)
    {
        return $this->update($params, $id);
    }

    /**
     * Create a new account.
     *
     * @param array $params
     * @return \App\Models\Account
     */
    public function createAccount($params)
    {
        return $this->create($params);
    }

    /**
     * Get account details by ID (same as getAccountDetail).
     *
     * @param int $id
     * @return \App\Models\Account
     */
    public function detailAccount($id)
    {
        return $this->find($id);
    }

    /**
     * Delete an account by ID.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteAccount($id)
    {
        return $this->delete($id);
    }
}
