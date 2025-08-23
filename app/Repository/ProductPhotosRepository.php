<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\Interfaces\ProductPhotoInterface;
use App\Models\ProductPhoto;

class ProductPhotosRepository extends BaseRepositoryImplementation implements ProductPhotoInterface
{
    public function model()
    {
        return ProductPhoto::class;
    }

    public function addProductPhotos($productId, $data)
    {
        $photosData = array_map(function ($photo) use ($productId) {
            return [
                'product_id' => $productId,
                'photo' => $photo,
            ];
        }, $data);

        return $this->createMultiple($photosData);
    }

    public function DeleteProductPhotos($productId)
    {
        $photos = $this->where('product_id', $productId)->get();
        foreach ($photos as $photo) {
            deleteImage($photo->photo);
        }

    }

    public function DeleteProductPhoto($productPhoto)
    {
        deleteImage($productPhoto->photo);
        $this->deleteById($productPhoto->id);

    }

    public function updateProductPhotos($productId, $data)
    {
        //        $photos = $this->where('product_id', $productId)->get();
        //        foreach ($photos as $photo) {
        //            deleteImage($photo->photo);
        //        }
        //        $this->where('product_id', $productId)->delete();
        $photosData = array_map(function ($photo) use ($productId) {
            return [
                'product_id' => $productId,
                'photo' => $photo,
            ];
        }, $data);

        return $this->createMultiple($photosData);
    }
}
