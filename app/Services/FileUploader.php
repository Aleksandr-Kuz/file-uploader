<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class FileUploader
{
    /**
     * @return string
     */
    protected static function getRemotePath(): string {
        return 'pdf_files';
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public static function upload(UploadedFile $file): string {

        $remotePath = static::getRemotePath();
        $filename = $file->store($remotePath, 's3');

        return Storage::disk('s3')->url($filename);
    }
}
