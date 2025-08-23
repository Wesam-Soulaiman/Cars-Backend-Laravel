<?php

namespace App\Repository;

use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Interfaces\AuthInterface;
use App\Models\Employee;
use App\Models\Permission;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthInterface
{
    public function Login($data)
    {
        $user = Employee::where('email', $data['email'])->first();
        $type = 'employee';

        if (! $user) {
            $user = Store::where('email', $data['email'])->first();
            $type = 'store';
        }

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return ApiResponseHelper::sendMessageResponse('UNAUTHORIZED', ApiResponseCodes::UNAUTHORIZED, false);
        }

        $token = $user->createToken('MyApp', [$type])->plainTextToken;

        $userData = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role_id' => $user->role_id ?? null,
            'type' => $type,
        ];

        $permissions = [];
        if ($type === 'employee') {
            $permissions = $user->permissions->map(function ($permission) {
                return [
                    'id' => $permission->id,
                    'guard_name' => $permission->guard_name,
                ];
            });
        }
        if ($type === 'store') {
            $permissions = Permission::select('id', 'guard_name')->whereIn('guard_name', [
                'dashboard.access',
                'products.view',
                'products.create',
                'products.update',
                'products.delete',
                'offers.view',
                'offers.create',
                'offers.update',
                'offers.delete',
                'orders.view',
            ])->get();

        }

        $data = [
            'token' => $token,
            'user' => $userData,
            'permissions' => $permissions,
        ];

        return ApiResponseHelper::sendResponse(new Result($data));
    }

    public function refreshToken()
    {
        $user = Auth::guard('employee')->user();
        $type = 'employee';

        if (! $user) {
            $user = Auth::guard('store')->user();
            $type = 'store';

        }
        if (! $user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $permissions = [];
        if ($type === 'employee') {
            $permissions = $user->permissions->map(function ($permission) {
                return [
                    'id' => $permission->id,
                    'guard_name' => $permission->guard_name,
                ];
            });
        }
        if ($type === 'store') {
            $permissions = Permission::select('id', 'guard_name')->whereIn('guard_name', [
                'dashboard.access',
                'products.view',
                'products.create',
                'products.update',
                'products.delete',
                'offers.view',
                'offers.create',
                'offers.update',
                'offers.delete',
                'orders.view',
            ])->get();

        }
        $user->tokens()->delete();
        $newToken = $user->createToken('auth-token')->plainTextToken;
        $userData = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role_id' => $user->role_id ?? null,
            'type' => $type,
        ];
        $data = [
            'token' => $newToken,
            'user' => $userData,
            'permissions' => $permissions,
        ];

        return ApiResponseHelper::sendResponse(new Result($data));

    }

    public function getMe()
    {
        $user = Auth::guard('employee')->user();
        $type = 'employee';
        if ($user) {

            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'name_ar' => $user->name_ar,
                'email' => $user->email,
                'role_id' => $user->role_id ?? null,
                'type' => $type,
            ];
        }
        if (! $user) {
            $user = Auth::guard('store')->user();
            $type = 'store';
            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'name_ar' => $user->name_ar,
                'photo' => url($user->photo),
                'email' => $user->email,
                'type' => $type,
            ];
        }

        $permissions = [];
        if ($type === 'employee') {
            $permissions = $user->permissions->map(function ($permission) {
                return [
                    'id' => $permission->id,
                    'guard_name' => $permission->guard_name,
                ];
            });
        }
        if ($type === 'store') {
            $permissions = Permission::select('id', 'guard_name')->whereIn('guard_name', [
                'dashboard.access',
                'products.view',
                'products.create',
                'products.update',
                'products.delete',
                'offers.view',
                'offers.create',
                'offers.update',
                'offers.delete',
                'orders.view',
            ])->get();

        }

        $data = [
            'user' => $userData,
            'permissions' => $permissions,
        ];

        return ApiResponseHelper::sendResponse(new Result($data));
    }
}
