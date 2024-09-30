<?php

namespace App\Interfaces\Services;

interface RoleServiceInterface
{
    /**
     * Danh sách các Role với các tham số tùy chọn.
     *
     * @return mixed
     */
    public function listRoles();

    /**
     * Lấy chi tiết của Role theo ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getRoleDetail(int $id);

    /**
     * Tạo mới một Role.
     *
     * @param array $data
     * @return mixed
     */
    public function createRole(array $data);

    /**
     * Cập nhật một Role theo ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateRole(int $id, array $data);

    /**
     * Xóa một Role theo ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteRole(int $id);
}
