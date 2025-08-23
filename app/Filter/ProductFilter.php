<?php

namespace App\Filter;

class ProductFilter extends BaseFilter
{
    public function __construct()
    {
        $this->id = null;
        $this->name = null;
        $this->MaxPrice = null;
        $this->MinPrice = null;
        $this->structure_id = null;
        $this->brand_id = null;
        $this->model_id = null;
        $this->store_id = null;
        $this->minYear = null;
        $this->maxYear = null;
        $this->type = null;
        $this->fuel_type = null;
        $this->lights = null; // Added for lights
    }

    protected ?int $id;
    protected ?string $name;
    protected ?string $type;
    protected ?string $fuel_type;
    protected ?float $MaxPrice;
    protected ?float $MinPrice;
    protected ?int $brand_id;
    protected ?int $structure_id;
    protected ?int $model_id;
    protected ?int $store_id;
    protected ?string $minYear;
    protected ?string $maxYear;
    protected ?string $lights; // Added for lights

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getMaxPrice(): ?float
    {
        return $this->MaxPrice;
    }

    public function setMaxPrice(?float $MaxPrice): void
    {
        $this->MaxPrice = $MaxPrice;
    }

    public function getMinPrice(): ?float
    {
        return $this->MinPrice;
    }

    public function setMinPrice(?float $MinPrice): void
    {
        $this->MinPrice = $MinPrice;
    }

    public function getStructureId(): ?int
    {
        return $this->structure_id;
    }

    public function setStructureId(?int $structure_id): void
    {
        $this->structure_id = $structure_id;
    }

    public function getBrandId(): ?int
    {
        return $this->brand_id;
    }

    public function setBrandId(?int $brand_id): void
    {
        $this->brand_id = $brand_id;
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

    public function getMinYear(): ?string
    {
        return $this->minYear;
    }

    public function setMinYear(?string $minYear): void
    {
        $this->minYear = $minYear;
    }

    public function getMaxYear(): ?string
    {
        return $this->maxYear;
    }

    public function setMaxYear(?string $maxYear): void
    {
        $this->maxYear = $maxYear;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getFuelType(): ?string
    {
        return $this->fuel_type;
    }

    public function setFuelType(?string $fuel_type): void
    {
        $this->fuel_type = $fuel_type;
    }

    public function getLights(): ?string // Added for lights
    {
        return $this->lights;
    }

    public function setLights(?string $lights): void // Added for lights
    {
        $this->lights = $lights;
    }
}
