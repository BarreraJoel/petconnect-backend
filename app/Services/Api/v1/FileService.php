<?php

namespace App\Services\Api\v1;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function __construct() {}

    public function upload(UploadedFile $file, string $path, string $name)
    {
        return $file->storeAs($path, $name, 'public');
    }

    public function removeImage(string $path)
    {
        return Storage::disk('public')->delete($path);
    }

    public function generateFileName($uuid, ?int $number = null)
    {
        $filename = $uuid . '_' . now()->format('dmY_His');
        if ($number) {
            $filename .= '_' . ($number >= 10 ? $number : "0$number");
        }
        $filename .= '.jpg';

        return $filename;
    }
}
