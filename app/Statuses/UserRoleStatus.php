<?php

namespace App\Statuses;

class UserRoleStatus
{
    public const ADMIN = 'admin';

    public const EMPLOYEE = 'employee';

    public static array $statuses = [self::ADMIN, self::EMPLOYEE];
}
