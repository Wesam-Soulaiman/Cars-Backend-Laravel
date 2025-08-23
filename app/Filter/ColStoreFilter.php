<?php

namespace App\Filter;

class ColStoreFilter extends BaseFilter
{
    public function __construct()
    {
        $this->col = null;
        $this->value = null;

    }

    protected ?string $col;

    protected ?string $value;

    public function getCol(): ?string
    {
        return $this->col;
    }

    public function setCol(?string $col): void
    {
        $this->col = $col;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): void
    {
        $this->value = $value;
    }
}
