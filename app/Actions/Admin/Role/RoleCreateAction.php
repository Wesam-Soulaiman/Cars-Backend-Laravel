<?php

namespace App\Actions\Admin\Role;

use App\Http\Requests\RoleRequest;
use App\Repository\RoleRepository;

class RoleCreateAction
{
    public function __construct(protected RoleRepository $roleRepository) {}

    public function __invoke(RoleRequest $request)
    {
        return $this->roleRepository->addRole($request->validated());
    }
}
