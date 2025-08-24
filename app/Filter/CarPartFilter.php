<?php

namespace App\Filter;

class CarPartFilter extends BaseFilter
{
    public function __construct()
    {
        $this->category_id = null;
        $this->model_id = null;
        $this->store_id = null;
        $this->creation_country = null;
    }

    protected ?int $category_id;
    protected ?int $model_id;
    protected ?int $store_id;
    protected ?string $creation_country;

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(?int $category_id): void
    {
        $this->category_id = $category_id;
    }

    public function getModelId(): ?int
    {
        return $this->model_id;
    }

    public function setModelId(?int $model_id): void
    {
        $this->model_id = $model_id;
    }

    public function getStoreId(): ?int
    {
        return $this->store_id;
    }

    public function setStoreId(?int $store_id): void
    {
        $this->store_id = $store_id;
    }

    public function getCreationCountry(): ?string
    {
        return $this->creation_country;
    }

    public function setCreationCountry(?string $creation_country): void
    {
        $this->creation_country = $creation_country;
    }
}
