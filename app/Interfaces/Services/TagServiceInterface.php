<?php

namespace App\Interfaces\Services;

interface TagServiceInterface
{
    /**
     * Lấy chi tiết của Tag theo ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getTagDetail(int $id);

    /**
     * Tạo mới một Tag.
     *
     * @param array $data
     * @return mixed
     */
    public function createTag(array $data);

    /**
     * Cập nhật một Tag theo ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateTag(int $id, array $data);

    /**
     * Xóa một Tag theo ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteTag(int $id);
}
