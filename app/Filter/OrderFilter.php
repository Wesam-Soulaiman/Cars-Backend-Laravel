<?php

namespace App\Filter;

class OrderFilter extends BaseFilter
{
    public function __construct()
    {
        $this->service_id = null;
        $this->store_id = null;
        $this->created_at = null;
        $this->active = null;

    }

    protected ?int $store_id;

    protected ?int $active;

    protected ?int $service_id;

    protected ?string $created_at;

    public function getStoreId(): ?int
    {
        return $this->store_id;
    }

    public function setStoreId(?int $store_id): void
    {
        $this->store_id = $store_id;
    }

    public function getServiceId(): ?int
    {
        return $this->service_id;
    }

    public function setServiceId(?int $service_id): void
    {
        $this->service_id = $service_id;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function setCreatedAt(?string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getActive(): ?int
    {
        return $this->active;
    }

    public function setActive(?int $active): void
    {
        $this->active = $active;
    }
}
