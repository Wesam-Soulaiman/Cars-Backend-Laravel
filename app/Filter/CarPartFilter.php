<?php

namespace App\Filter;

class CarPartFilter extends BaseFilter
{
    public function __construct()
    {
        $this->id = null;
        $this->category_id = null;
        $this->model_id = null;
        $this->store_id = null;
        $this->minPrice = null;
        $this->maxPrice = null;
        $this->creation_country = null;
        $this->orderBy = null;
        $this->order = null;
    }

    protected ?int $id;
    protected ?int $category_id;
    protected ?int $model_id;
    protected ?int $store_id;
    protected ?float $minPrice;
    protected ?float $maxPrice;
    protected ?string $creation_country;
    public ?string $orderBy;
    public ?string $order;

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): void { $this->id = $id; }

    public function getCategoryId(): ?int { return $this->category_id; }
    public function setCategoryId(?int $category_id): void { $this->category_id = $category_id; }

    public function getModelId(): ?int { return $this->model_id; }
    public function setModelId(?int $model_id): void { $this->model_id = $model_id; }

    public function getStoreId(): ?int { return $this->store_id; }
    public function setStoreId(?int $store_id): void { $this->store_id = $store_id; }

    public function getMinPrice(): ?float { return $this->minPrice; }
    public function setMinPrice(?float $minPrice): void { $this->minPrice = $minPrice; }

    public function getMaxPrice(): ?float { return $this->maxPrice; }
    public function setMaxPrice(?float $maxPrice): void { $this->maxPrice = $maxPrice; }

    public function getCreationCountry(): ?string { return $this->creation_country; }
    public function setCreationCountry(?string $creation_country): void { $this->creation_country = $creation_country; }

    public function getOrderBy(): ?string { return $this->orderBy; }
    public function setOrderBy(?string $orderBy): void { $this->orderBy = $orderBy; }

    public function getOrder(): ?string { return $this->order; }
    public function setOrder(?string $order): void { $this->order = $order; }
}
