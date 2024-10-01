<?php

namespace App\Interfaces\Services;

interface PostServiceInterface
{
    /**
     * Lấy chi tiết của Post theo ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getPostDetail(int $id);

    /**
     * Tạo mới một Post.
     *
     * @param array $data
     * @return mixed
     */
    public function createPost(array $data);

    /**
     * Cập nhật một Post theo ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updatePost(int $id, array $data);

    /**
     * Xóa một Post theo ID.
     *
     * @param int $id
     * @return bool
     */
    public function deletePost(int $id);
}
