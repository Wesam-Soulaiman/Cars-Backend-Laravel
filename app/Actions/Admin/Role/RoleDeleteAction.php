<?php

namespace App\Actions\Admin\Role;

use App\Models\Role;
use App\Repository\RoleRepository;

class RoleDeleteAction
{
    public function __construct(protected RoleRepository $roleRepository) {}

    public function __invoke(Role $role)
    {
        return $this->roleRepository->deleteRole($role);
    }
}
