<?php

namespace App\Interfaces;

use App\Filter\ProductFilter;
use App\Models\Product;

interface ProductInterface
{
    public function addProduct($data);

    public function SearchProducts(ProductFilter $filters);

    public function updateProduct(Product $product, $data);

    public function deleteProduct(Product $product);

    public function showProduct($id);

    public function indexProduct(ProductFilter $filters);

    public function productSpecial();

    public function productCountAvailable();
}
