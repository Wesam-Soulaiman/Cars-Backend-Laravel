<?php

namespace App\Http\Middleware;

use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEmployeePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): \Symfony\Component\HttpFoundation\Response  $next
     * @param  string  $permission  The required permission.
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        // Get the authenticated employee.
        // Adjust the guard name if you are using a custom guard, e.g., 'employee'.
        if (auth('store')->check()) {
            $allowedPermissions = [
                'dashboard.access',
                'brands.view',
                'models.view',
                'products.view',
                'products.create',
                'products.update',
                'products.delete',
                'offers.view',
                'offers.create',
                'offers.update',
                'offers.delete',
                'orders.view',

                'structure.view',
                'store_type.view',
                'governorate.view',
                'light.view',
                'gear.view',
                'fuel_type.view',
                'color.view',
                'car_part_categories.view',
                'car_part.view',
                'car_part.create',
                'car_part.update',
                'car_part.delete',

            ];
            if (! in_array($permission, $allowedPermissions)) {
                return ApiResponseHelper::sendMessageResponse(
                    'Unauthorized action',
                    ApiResponseCodes::FORBIDDEN,
                    false
                );
            }

            return $next($request);
        }
        $employee = auth('employee')->user();
        // If no employee is logged in or the employee lacks the permission, abort with a 403.
        if (! $employee || ! $employee->hasPermission($permission)) {
            return ApiResponseHelper::sendMessageResponse('Unauthorized action', ApiResponseCodes::FORBIDDEN, false);
        }

        return $next($request);
    }
}
