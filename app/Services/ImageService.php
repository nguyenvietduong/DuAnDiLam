<?php

namespace App\Services;

use App\Interfaces\Services\ImageServiceInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class ImageService implements ImageServiceInterface
{
    /**
     * Generate a unique file name based on the original file name and current timestamp.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string
     */
    public function generateUniqueFileName(UploadedFile $file): string
    {
        $timestamp = time();
        $extension = $file->getClientOriginalExtension();
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        return "{$fileName}_{$timestamp}.{$extension}";
    }

    /**
     * Store an image in the specified path.
     *
     * @param string $directory
     * @param \Illuminate\Http\UploadedFile $file
     * @return string
     */
    public function storeImage(string $directory, UploadedFile $file): string
    {
        $fileName = $this->generateUniqueFileName($file);
        $filePath = "{$directory}/{$fileName}";

        Storage::put($filePath, file_get_contents($file));

        return $filePath;
    }

    /**
     * Store an image in S3 (or MinIO).
     *
     * @param string $directory
     * @param \Illuminate\Http\UploadedFile $file
     * @return string
     */
    public function storeImageS3(string $directory, UploadedFile $file): string
    {
        $fileName = $this->generateUniqueFileName($file);
        $filePath = "{$directory}/{$fileName}";

        Storage::disk('s3')->put($filePath, file_get_contents($file));

        return $filePath;
    }

    /**
     * Update an existing image.
     *
     * @param string $directory
     * @param \Illuminate\Http\UploadedFile $file
     * @param string|null $oldImagePath
     * @return string
     */
    public function updateImage(string $directory, UploadedFile $file, ?string $oldImagePath = null): string
    {
        if ($oldImagePath) {
            $this->deleteImage($oldImagePath);
        }

        return $this->storeImage($directory, $file);
    }

    /**
     * Update an existing image in S3 (or MinIO).
     *
     * @param string $directory
     * @param \Illuminate\Http\UploadedFile $file
     * @param string|null $oldImagePath
     * @return string
     */
    public function updateImageS3(string $directory, UploadedFile $file, ?string $oldImagePath = null): string
    {
        if ($oldImagePath) {
            $this->deleteImageS3($oldImagePath);
        }

        return $this->storeImageS3($directory, $file);
    }

    /**
     * Delete an image from the storage.
     *
     * @param string $path
     * @return bool
     */
    public function deleteImage(string $path): bool
    {
        if (Storage::exists($path)) {
            return Storage::delete($path);
        }

        return false;
    }

    /**
     * Delete an image from S3 (or MinIO).
     *
     * @param string $path
     * @return bool
     */
    public function deleteImageS3(string $path): bool
    {
        if (Storage::disk('s3')->exists($path)) {
            return Storage::disk('s3')->delete($path);
        }

        return false;
    }

    /**
     * Handle exceptions during image processing.
     *
     * @param \Exception $e
     * @param array $payload
     * @param string|null $oldImagePath
     */
    public function handleImageException(\Exception $e, array $payload, ?string $oldImagePath = null)
    {
        // Log the error message
        Log::error('Image processing error: ' . $e->getMessage());

        // If there was an old image path, delete the new image that failed to upload
        if (isset($payload['image'])) {
            $this->deleteImage($payload['image']);
        }

        // If there was an old image path, ensure it remains unchanged
        if ($oldImagePath) {
            $payload['image'] = $oldImagePath;
        }

        // Throw the exception to be handled by the caller
        throw $e;
    }

    public function handleImageS3Exception(\Exception $e, array $payload, ?string $oldImagePath = null)
    {
        // Log the error message
        Log::error('Image processing error: ' . $e->getMessage());

        // If there was an old image path, delete the new image that failed to upload
        if (isset($payload['image'])) {
            $this->deleteImageS3($payload['image']);
        }

        // If there was an old image path, ensure it remains unchanged
        if ($oldImagePath) {
            $payload['image'] = $oldImagePath;
        }

        // Throw the exception to be handled by the caller
        throw $e;
    }
}
