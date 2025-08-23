<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'name_ar'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    public function getPermissionsWithStatus()
    {
        return Permission::select('permissions.id', 'permissions.guard_name')
            ->selectRaw(
                'CASE WHEN role_permissions.role_id IS NOT NULL THEN true ELSE false END AS status'
            )
            ->leftJoin('role_permissions', function ($join) {
                $join->on('permissions.id', '=', 'role_permissions.permission_id')
                    ->where('role_permissions.role_id', $this->id);
            })->orderBy('permissions.id')->get()->map(function ($permission) {
                $permission->status = (bool) $permission->status;

                return $permission;
            });
    }
}
