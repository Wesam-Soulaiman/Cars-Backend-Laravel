<?php

namespace App\Actions\Admin\Products;

use App\Models\ProductPhoto;
use App\Repository\ProductPhotosRepository;

class ProductPhotoDeleteAction
{
    public function __construct(protected ProductPhotosRepository $productPhotosRepository) {}

    public function __invoke(ProductPhoto $productPhoto)
    {

        return $this->productPhotosRepository->DeleteProductPhoto($productPhoto);
    }
}
