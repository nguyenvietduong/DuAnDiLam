<?php

namespace App\Interfaces\Services;

interface CategoryServiceInterface
{
    /**
     * Lấy chi tiết của Category theo ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getCategoryDetail(int $id);

    /**
     * Tạo mới một Category.
     *
     * @param array $data
     * @return mixed
     */
    public function createCategory(array $data);

    /**
     * Cập nhật một Category theo ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateCategory(int $id, array $data);

    /**
     * Xóa một Category theo ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteCategory(int $id);
}
