<?php

namespace App\Interfaces\Services;

interface AccountServiceInterface
{
    /**
     * Lấy chi tiết của Account theo ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getAccountDetail(int $id);

    /**
     * Tạo mới một Account.
     *
     * @param array $data
     * @return mixed
     */
    public function createAccount(array $data);

    /**
     * Cập nhật một Account theo ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateAccount(int $id, array $data);

    /**
     * Xóa một Account theo ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteAccount(int $id);
}
