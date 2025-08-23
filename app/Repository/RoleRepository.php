<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Interfaces\RoleInterface;
use App\Models\Role;

class RoleRepository extends BaseRepositoryImplementation implements RoleInterface
{
    public function model()
    {
        return Role::class;
    }

    public function addRole($data)
    {
        $role = $this->create($data);

        return ApiResponseHelper::sendResponse(new Result($role), ApiResponseCodes::CREATED);
    }

    public function updateRole(Role $role, $data)
    {
        $newRole = $this->updateById($role->id, $data);

        return ApiResponseHelper::sendResponse(new Result($newRole));
    }

    public function deleteRole(Role $role)
    {
        $this->deleteById($role->id);

        return ApiResponseHelper::sendMessageResponse('delete role  successfully');
    }

    public function showRole(Role $role)
    {
        $showRole = $this->getById($role->id, ['id', 'name', 'name_ar']);
        $getPermissionsWithStatus = $showRole->getPermissionsWithStatus();

        return ApiResponseHelper::sendResponse(new Result([
            'id' => $showRole->id,
            'name' => $showRole->name,
            'permissions' => $getPermissionsWithStatus,
        ]));
    }

    public function indexRole()
    {
        $roles = $this->get(['id', 'name', 'name_ar']);

        return ApiResponseHelper::sendResponse(new Result($roles));
    }

    public function updatePermissionEmployee(Role $role, $data)
    {
        $role->permissions()->sync($data['permission_ids']);

        return ApiResponseHelper::sendMessageResponse(' update permission  successfully');

    }
}
