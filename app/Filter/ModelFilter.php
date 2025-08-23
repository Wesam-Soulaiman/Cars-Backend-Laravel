<?php

namespace App\Filter;

class ModelFilter extends BaseFilter
{
    public function __construct()
    {
        $this->name = null;
        $this->name_ar = null;
        $this->brand_id = null;

    }

    protected ?string $name;

    protected ?string $name_ar;

    protected ?string $brand_id;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getBrandId(): ?string
    {
        return $this->brand_id;
    }

    public function setBrandId(?string $brand_id): void
    {
        $this->brand_id = $brand_id;
    }

    public function getNameAr(): ?string
    {
        return $this->name_ar;
    }

    public function setNameAr(?string $name_ar): void
    {
        $this->name_ar = $name_ar;
    }
}
