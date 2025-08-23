<?php

namespace App\Interfaces;

use App\Models\Role;

interface RoleInterface
{
    public function addRole($data);

    public function updateRole(Role $role, $data);

    public function updatePermissionEmployee(Role $role, $data);

    public function deleteRole(Role $role);

    public function showRole(Role $role);

    public function indexRole();
}
