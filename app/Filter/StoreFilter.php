<?php

namespace App\Filter;

class StoreFilter extends BaseFilter
{
    public function __construct()
    {
        $this->id = null;
        $this->name = null;
        $this->name_ar = null;
        $this->address = null;

    }

    protected ?int $id;

    protected ?string $name;

    protected ?string $name_ar;

    protected ?string $address;

    protected ?string $address_ar;

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

    public function getNameAr(): ?string
    {
        return $this->name_ar;
    }

    public function setNameAr(?string $name_ar): void
    {
        $this->name_ar = $name_ar;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getAddressAr(): ?string
    {
        return $this->address_ar;
    }

    public function setAddressAr(?string $address_ar): void
    {
        $this->address_ar = $address_ar;
    }
}
