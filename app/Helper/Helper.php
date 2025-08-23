<?php

use Illuminate\Support\Facades\File;

function deleteImage($imagePath)
{
    $fullPath = public_path($imagePath);

    if (File::exists($fullPath)) {
        File::delete($fullPath);

        return true;
    }

    return false;
}
