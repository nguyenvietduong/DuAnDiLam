<?php

namespace App\Interfaces\Services;

use Illuminate\Http\UploadedFile;

interface ImageServiceInterface
{
    /**
     * Generate a unique file name based on the original file name and current timestamp.
     * This method is responsible for generating a unique name for the uploaded image 
     * to avoid file name conflicts in the storage. It uses the original file name 
     * and appends the current timestamp.
     *
     * @param \Illuminate\Http\UploadedFile $file The uploaded file object.
     * @return string The generated unique file name.
     */
    public function generateUniqueFileName(UploadedFile $file): string;

    /**
     * Store an image in the specified directory.
     * This method handles storing the uploaded image in a given directory. 
     * It returns the URL or path of the stored image.
     *
     * @param string $directory Directory to store the image.
     * @param \Illuminate\Http\UploadedFile $file The uploaded image file.
     * @return string The URL or path of the stored image.
     */
    public function storeImage(string $directory, UploadedFile $file): string;

    /**
     * Store an image in S3 (or MinIO).
     * This method uploads the image file to an S3-compatible storage.
     * It returns the path or URL of the image in S3.
     *
     * @param string $directory The directory or folder path in the S3 bucket.
     * @param \Illuminate\Http\UploadedFile $file The uploaded image file.
     * @return string The URL or path of the image in S3.
     */
    public function storeImageS3(string $directory, UploadedFile $file): string;

    /**
     * Update an existing image, optionally deleting the old image if provided.
     * This method replaces an old image with a new one. If an old image path 
     * is provided, it deletes the old image and stores the new image.
     *
     * @param string $directory Directory to store the new image.
     * @param \Illuminate\Http\UploadedFile $file The new image file.
     * @param string|null $oldImagePath Optional path of the old image to be deleted.
     * @return string The URL or path of the updated image.
     */
    public function updateImage(string $directory, UploadedFile $file, ?string $oldImagePath = null): string;

    /**
     * Update an existing image in S3 (or MinIO).
     * This method replaces an old image stored in S3 with a new one. It optionally
     * deletes the old image and stores the new image in the specified directory.
     *
     * @param string $directory Directory to store the new image in S3.
     * @param \Illuminate\Http\UploadedFile $file The new image file.
     * @param string|null $oldImagePath Optional path of the old image to be deleted from S3.
     * @return string The URL or path of the updated image in S3.
     */
    public function updateImageS3(string $directory, UploadedFile $file, ?string $oldImagePath = null): string;

    /**
     * Delete an image from storage.
     * This method deletes the image from local storage, given the file path. 
     * It returns true if the deletion is successful or false if the file is not found.
     *
     * @param string $path The path of the image to be deleted.
     * @return bool Returns true if the image is successfully deleted, false otherwise.
     */
    public function deleteImage(string $path): bool;

    /**
     * Delete an image from S3 (or MinIO).
     * This method deletes the image from S3 storage, given the file path. 
     * It returns true if the deletion is successful or false if the file is not found.
     *
     * @param string $path The path of the image to be deleted from S3.
     * @return bool Returns true if the image is successfully deleted, false otherwise.
     */
    public function deleteImageS3(string $path): bool;

    /**
     * Handle exceptions during image processing.
     * This method handles any exceptions that occur while processing an image. 
     * It logs the error, optionally deletes the failed image, and maintains 
     * the original image if an old image path is provided.
     *
     * @param \Exception $e The exception thrown during image processing.
     * @param array $payload Additional image data and context for error handling.
     * @param string|null $oldImagePath Optional path of the old image that should not be changed.
     * @return void
     */
    public function handleImageException(\Exception $e, array $payload, ?string $oldImagePath = null);

    /**
     * Handle exceptions during S3 image processing.
     * This method handles exceptions that occur while processing images on S3. 
     * It logs the error, optionally deletes the failed image, and maintains the 
     * original image if an old image path is provided.
     *
     * @param \Exception $e The exception thrown during image processing on S3.
     * @param array $payload Additional image data and context for error handling.
     * @param string|null $oldImagePath Optional path of the old image that should not be changed.
     * @return void
     */
    public function handleImageS3Exception(\Exception $e, array $payload, ?string $oldImagePath = null);
}
