<?php

namespace App\Actions\Admin\Role;

use App\Models\Role;
use App\Repository\RoleRepository;

class RoleShowAction
{
    public function __construct(protected RoleRepository $roleRepository) {}

    public function __invoke(Role $role)
    {
        return $this->roleRepository->showRole($role);
    }
}
