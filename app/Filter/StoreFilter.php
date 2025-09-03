<?php

namespace App\Filter;

class StoreFilter extends BaseFilter
{
    public function __construct()
{
    $this->name = null;
    $this->governorate_id = null;
}

    protected ?string $name;
    protected ?int $governorate_id;

    public function getName(): ?string
{
    return $this->name;
}

    public function setName(?string $name): void
{
    $this->name = $name;
}

    public function getGovernorateId(): ?int
{
    return $this->governorate_id;
}

    public function setGovernorateId(?int $governorate_id): void
{
    $this->governorate_id = $governorate_id;
}
}
