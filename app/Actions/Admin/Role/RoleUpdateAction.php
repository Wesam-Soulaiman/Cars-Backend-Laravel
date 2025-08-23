<?php

namespace App\Actions\Admin\Role;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Repository\RoleRepository;

class RoleUpdateAction
{
    public function __construct(protected RoleRepository $roleRepository) {}

    public function __invoke(Role $role, RoleRequest $request)
    {
        return $this->roleRepository->updateRole($role, $request->validated());
    }
}
