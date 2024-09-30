<?php

namespace App\Interfaces\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface RoleRepositoryInterface extends RepositoryInterface
{
    /**
     * Danh sách các Role với các tham số lọc tùy chọn.
     *
     * @return mixed
     */
    public function getAllRoles();

    /**
     * Lấy chi tiết của Role theo ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getRoleDetail(int $id);

    /**
     * Cập nhật một Role theo ID với dữ liệu mới.
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updateRole(int $id, array $params);

    /**
     * Tạo mới một Role với dữ liệu.
     *
     * @param array $params
     * @return mixed
     */
    public function createRole(array $params);

    /**
     * Lấy chi tiết của Role theo ID. (Có thể trùng với phương thức `getRoleDetail`)
     *
     * @param int $id
     * @return mixed
     */
    public function detailRole(int $id);

    /**
     * Xóa một Role theo ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteRole(int $id);
}
