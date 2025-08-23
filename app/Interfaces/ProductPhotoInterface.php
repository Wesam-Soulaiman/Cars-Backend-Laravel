<?php

namespace App\Interfaces;

interface ProductPhotoInterface
{
    public function addProductPhotos($productId, $data);

    public function updateProductPhotos($productId, $data);

    public function DeleteProductPhotos($productId);
}
