<?php

namespace App\Services;

use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Interfaces\Services\CategoryServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class CategoryService extends BaseService implements CategoryServiceInterface
{
    protected $categoryRepository;

    /**
     * Tạo mới instance của CategoryService.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        CategoryRepositoryInterface  $categoryRepository,
    ) {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Lấy chi tiết của category theo ID.
     *
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getCategoryDetail(int $id)
    {
        try {
            return $this->categoryRepository->getCategoryDetail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Category không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể lấy chi tiết category: ' . $e->getMessage());
        }
    }

    /**
     * Tạo mới một category.
     *
     * @param array $data
     * @return mixed
     */

    public function createCategory(array $data)
    {
        try {
            return $this->categoryRepository->createCategory($data);
        } catch (\Exception $e) {
            throw new \Exception('Unable to create category: ' . $e->getMessage());
        }
    }

    /**
     * Cập nhật một category theo ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updateCategory(int $id, array $data)
    {
        try {
            return $this->categoryRepository->updateCategory($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Category không tồn tại với ID: ' . $id);
        } catch (\Exception $e) {
            throw new \Exception('Unable to update category: ' . $e->getMessage());
        }
    }

    /**
     * Xóa một category theo ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function deleteCategory(int $id)
    {
        try {
            return $this->categoryRepository->deleteCategory($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Category không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể xóa category: ' . $e->getMessage());
        }
    }
}
