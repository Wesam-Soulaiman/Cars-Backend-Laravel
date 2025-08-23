<?php

namespace App\Actions\Admin\Role;

use App\Http\Requests\RolePermissionsRequest;
use App\Models\Role;
use App\Repository\RoleRepository;

class RolePermissionAction
{
    public function __construct(protected RoleRepository $roleRepository) {}

    public function __invoke(Role $role, RolePermissionsRequest $request)
    {
        return $this->roleRepository->updatePermissionEmployee($role, $request->validated());
    }
}
