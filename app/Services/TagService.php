<?php

namespace App\Services;

use App\Interfaces\Repositories\TagRepositoryInterface;
use App\Interfaces\Services\TagServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class TagService extends BaseService implements TagServiceInterface
{
    protected $tagRepository;

    /**
     * Tạo mới instance của TagService.
     *
     * @param TagRepositoryInterface $tagRepository
     */
    public function __construct(
        TagRepositoryInterface  $tagRepository,
    ) {
        $this->tagRepository = $tagRepository;
    }
    /**
     * Lấy chi tiết của tag theo ID.
     *
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getTagDetail(int $id)
    {
        try {
            return $this->tagRepository->getTagDetail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Tag không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể lấy chi tiết tag: ' . $e->getMessage());
        }
    }

    /**
     * Tạo mới một tag.
     *
     * @param array $data
     * @return mixed
     */

    public function createTag(array $data)
    {
        try {
            return $this->tagRepository->createTag($data);
        } catch (\Exception $e) {
            throw new \Exception('Unable to create tag: ' . $e->getMessage());
        }
    }

    /**
     * Cập nhật một tag theo ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updateTag(int $id, array $data)
    {
        try {
            return $this->tagRepository->updateTag($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Tag không tồn tại với ID: ' . $id);
        } catch (\Exception $e) {
            throw new \Exception('Unable to update tag: ' . $e->getMessage());
        }
    }

    /**
     * Xóa một tag theo ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function deleteTag(int $id)
    {
        try {
            return $this->tagRepository->deleteTag($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Tag không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể xóa tag: ' . $e->getMessage());
        }
    }
}
