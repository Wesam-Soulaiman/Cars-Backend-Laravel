<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'name_ar', 'phone', 'email', 'password', 'role_id'];

    protected $casts = [
        'password' => 'hashed',
    ];

    protected $hidden = [
        'password',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * The permissions that belong to the employee.
     */
    public function permissions()
    {
        return $this->role->permissions();
    }

    /**
     * Check if the employee has a given permission.
     */
    public function hasPermission(string $permission): bool
    {
        // Here we assume the 'permissions' table has a column (e.g., 'guard_name')
        // that stores the permission name.
        return $this->permissions()->where('guard_name', $permission)->exists();
    }
}
