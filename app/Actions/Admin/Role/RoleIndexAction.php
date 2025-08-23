<?php

namespace App\Actions\Admin\Role;

use App\Repository\RoleRepository;

class RoleIndexAction
{
    public function __construct(protected RoleRepository $roleRepository) {}

    public function __invoke()
    {
        return $this->roleRepository->indexRole();
    }
}
