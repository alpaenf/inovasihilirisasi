<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    /**
     * Compress, resize proportionately, and store an uploaded image into public storage.
     * Automatically converts raster images to modern, lightweight WebP format.
     *
     * @param UploadedFile $file
     * @param string $folder Sub-folder under storage/app/public (e.g. 'products', 'partners')
     * @param int $maxWidth Max width in pixels (default 1200)
     * @param int $maxHeight Max height in pixels (default 1200)
     * @param int $quality Compression quality 1-100 (default 82)
     * @return string Public URL path, e.g. '/storage/products/xyz123.webp'
     */
    public function compressAndStore(
        UploadedFile $file,
        string $folder = 'uploads',
        int $maxWidth = 1200,
        int $maxHeight = 1200,
        int $quality = 82
    ): string {
        $mime = $file->getMimeType();
        $extension = strtolower($file->getClientOriginalExtension());

        // For vector SVG, store directly without rasterizing
        if ($mime === 'image/svg+xml' || $extension === 'svg') {
            $path = $file->store($folder, 'public');
            return '/storage/' . $path;
        }

        // Create image resource from uploaded file
        $srcImage = null;
        $filePath = $file->getRealPath();

        switch ($mime) {
            case 'image/jpeg':
            case 'image/jpg':
                $srcImage = @imagecreatefromjpeg($filePath);
                // Handle EXIF orientation from smartphone cameras
                if ($srcImage && function_exists('exif_read_data')) {
                    $exif = @exif_read_data($filePath);
                    if (!empty($exif['Orientation'])) {
                        switch ($exif['Orientation']) {
                            case 3:
                                $srcImage = imagerotate($srcImage, 180, 0);
                                break;
                            case 6:
                                $srcImage = imagerotate($srcImage, -90, 0);
                                break;
                            case 8:
                                $srcImage = imagerotate($srcImage, 90, 0);
                                break;
                        }
                    }
                }
                break;
            case 'image/png':
                $srcImage = @imagecreatefrompng($filePath);
                break;
            case 'image/webp':
                $srcImage = function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($filePath) : null;
                break;
            case 'image/gif':
                $srcImage = @imagecreatefromgif($filePath);
                break;
        }

        // Fallback: If GD cannot process the image, store as normal
        if (!$srcImage) {
            $path = $file->store($folder, 'public');
            return '/storage/' . $path;
        }

        $origWidth = imagesx($srcImage);
        $origHeight = imagesy($srcImage);

        // Calculate proportional scale
        $ratio = min($maxWidth / $origWidth, $maxHeight / $origHeight, 1.0);
        $newWidth = (int) round($origWidth * $ratio);
        $newHeight = (int) round($origHeight * $ratio);

        // Create truecolor canvas
        $dstImage = imagecreatetruecolor($newWidth, $newHeight);

        // Preserve alpha transparency for PNG and WebP
        imagealphablending($dstImage, false);
        imagesavealpha($dstImage, true);
        $transparent = imagecolorallocatealpha($dstImage, 255, 255, 255, 127);
        imagefilledrectangle($dstImage, 0, 0, $newWidth, $newHeight, $transparent);

        // Resample with high quality interpolation
        imagecopyresampled(
            $dstImage,
            $srcImage,
            0, 0, 0, 0,
            $newWidth,
            $newHeight,
            $origWidth,
            $origHeight
        );

        // Ensure target directory exists in public disk
        Storage::disk('public')->makeDirectory($folder);

        // Generate unique filename with .webp extension
        $filename = Str::random(40) . '.webp';
        $relativeStoragePath = trim($folder, '/') . '/' . $filename;
        $absolutePath = Storage::disk('public')->path($relativeStoragePath);

        // Output compressed WebP
        $success = function_exists('imagewebp')
            ? imagewebp($dstImage, $absolutePath, $quality)
            : false;

        // Cleanup memory
        imagedestroy($srcImage);
        imagedestroy($dstImage);

        if (!$success) {
            // Fallback to default file storage if WebP encoding fails
            $path = $file->store($folder, 'public');
            return '/storage/' . $path;
        }

        return '/storage/' . $relativeStoragePath;
    }

    /**
     * Delete an existing image from storage if it is a local file.
     * Avoids deleting external URLs or placeholder assets.
     */
    public function deleteOldImage(?string $path): void
    {
        if (!$path) {
            return;
        }

        // Check if path starts with /storage/ and doesn't contain default placeholders
        if (str_starts_with($path, '/storage/') && !str_contains($path, 'placeholder')) {
            $relativePath = str_replace('/storage/', '', $path);
            if (Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
            }
        }
    }
}

