<?php

namespace App\Filter;

class StructureFilter extends BaseFilter
{
    public function __construct()
    {
        $this->name = null;
        $this->name_ar = null;
    }

    protected ?string $name;
    protected ?string $name_ar;

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
}
