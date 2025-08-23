<?php

namespace App\Statuses;

class ServiceCategoryStatus
{
    public const SUBSCRIPTION = 1;

    public const TOP_RESULT = 2;

    // Use the correct constant names in the array
    public static array $statuses = [self::SUBSCRIPTION, self::TOP_RESULT];
}
