<?php

namespace App\Filter;

class EmployeeFilter extends BaseFilter
{
    public function __construct()
    {
        $this->name = null;
        $this->name_ar = null;
        $this->role_id = null;

    }

    protected ?string $name;

    protected ?string $name_ar;

    protected ?int $role_id;

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

    public function getRoleId(): ?int
    {
        return $this->role_id;
    }

    public function setRoleId(?int $role_id): void
    {
        $this->role_id = $role_id;
    }
}
