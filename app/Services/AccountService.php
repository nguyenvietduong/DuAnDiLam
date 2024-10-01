<?php

namespace App\Services;

use App\Interfaces\Repositories\AccountRepositoryInterface;
use App\Interfaces\Services\AccountServiceInterface;
use App\Interfaces\Services\ImageServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Exception;

class AccountService extends BaseService implements AccountServiceInterface
{
    protected $accountRepository;
    protected $imageService;

    /**
     * Tạo mới instance của AccountService.
     *
     * @param AccountRepositoryInterface $accountRepository
     */
    public function __construct(
        AccountRepositoryInterface  $accountRepository,
        ImageServiceInterface       $imageService
    ) {
        $this->accountRepository = $accountRepository;
        $this->imageService      = $imageService;
    }
    /**
     * Lấy chi tiết của account theo ID.
     *
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getAccountDetail(int $id)
    {
        try {
            return $this->accountRepository->getAccountDetail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Account không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể lấy chi tiết account: ' . $e->getMessage());
        }
    }

    /**
     * Tạo mới một account.
     *
     * @param array $data
     * @return mixed
     */

    public function createAccount(array $data)
    {
        try {
            // Hash the password
            $data['password'] = Hash::make($data['password']);
            $image = null;

            // Xử lý upload ảnh từ request
            if (isset($data['image'])) {
                // Sử dụng dịch vụ ImageService để lưu ảnh vào S3
                $data['image'] = $this->imageService->storeImageS3('account_files', $data['image']);
            } elseif (session('image_temp')) {
                // Nếu có ảnh tạm lưu trong session 'image_temp'
                $tempImageName = session('image_temp');
                $tempImagePath = $tempImageName; // Đường dẫn ảnh tạm trong local storage

                // Kiểm tra xem ảnh tạm có tồn tại không
                if (Storage::exists($tempImagePath)) {
                    // Lấy đường dẫn đầy đủ của tệp trong local storage
                    $fullTempImagePath = Storage::path($tempImagePath);

                    // Tạo một đối tượng UploadedFile từ file đã lưu trong storage
                    $image = new UploadedFile(
                        $fullTempImagePath,       // Đường dẫn đầy đủ đến file
                        $tempImageName,           // Tên gốc của file
                        null,                     // Mime type (nếu null, Laravel sẽ tự động xác định)
                        null,                     // Kích thước của file
                        true                      // Đánh dấu file là "đã di chuyển" (already moved)
                    );

                    // Lưu ảnh vào S3
                    $data['image'] = $this->imageService->storeImageS3('account_files', $image);

                    // Xóa ảnh tạm sau khi upload lên S3 thành công
                    $this->imageService->deleteImage($tempImagePath);
                } else {
                    dd('Tệp không tồn tại trong local storage.');
                }
            }

            // Tạo tài khoản với dữ liệu đã xử lý
            return $this->accountRepository->createAccount($data);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ khi tạo tài khoản và log lỗi
            $this->imageService->handleImageS3Exception($e, $data);
            throw new \Exception('Unable to create account: ' . $e->getMessage());
        }
    }

    /**
     * Cập nhật một account theo ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updateAccount(int $id, array $data)
    {
        try {
            // Lấy thông tin tài khoản hiện tại để so sánh và xử lý hình ảnh
            $account      = $this->accountRepository->getAccountDetail($id);
            $oldImagePath = $account->image;
            $image        = null;

            // Nếu có ảnh mới trong dữ liệu yêu cầu
            if (isset($data['image'])) {
                // Sử dụng dịch vụ ImageService để cập nhật ảnh vào S3 và xoá ảnh cũ nếu cần
                $data['image'] = $this->imageService->updateImageS3('account_files', $data['image'], $oldImagePath);
            } elseif (session('image_temp')) {
                // Nếu có ảnh tạm lưu trong session 'image_temp'
                $tempImageName = session('image_temp');
                $tempImagePath = $tempImageName; // Đường dẫn ảnh tạm trong local storage

                // Kiểm tra xem ảnh tạm có tồn tại không
                if (Storage::exists($tempImagePath)) {
                    // Lấy đường dẫn đầy đủ của tệp trong local storage
                    $fullTempImagePath = Storage::path($tempImagePath);

                    // Tạo một đối tượng UploadedFile từ file đã lưu trong storage
                    $image = new UploadedFile(
                        $fullTempImagePath,       // Đường dẫn đầy đủ đến file
                        $tempImageName,           // Tên gốc của file
                        null,                     // Mime type (nếu null, Laravel sẽ tự động xác định)
                        null,                     // Kích thước của file
                        true                      // Đánh dấu file là "đã di chuyển" (already moved)
                    );

                    // Cập nhật ảnh vào S3 và xoá ảnh cũ nếu có
                    $data['image'] = $this->imageService->updateImageS3('account_files', $image, $oldImagePath);

                    // Xoá ảnh tạm sau khi upload lên S3 thành công
                    $this->imageService->deleteImage($tempImagePath);
                } else {
                    dd('Tệp không tồn tại trong local storage.');
                }
            }

            // Cập nhật tài khoản với dữ liệu đã xử lý
            return $this->accountRepository->updateAccount($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Account không tồn tại với ID: ' . $id);
        } catch (\Exception $e) {
            // Xử lý ngoại lệ khi cập nhật tài khoản và log lỗi
            $this->imageService->handleImageS3Exception($e, $data);
            throw new \Exception('Unable to update account: ' . $e->getMessage());
        }
    }

    /**
     * Xóa một account theo ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function deleteAccount(int $id)
    {
        try {
            return $this->accountRepository->deleteAccount($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Account không tồn tại với ID: ' . $id);
        } catch (Exception $e) {
            // Xử lý lỗi khác nếu cần thiết
            throw new Exception('Không thể xóa account: ' . $e->getMessage());
        }
    }
}
