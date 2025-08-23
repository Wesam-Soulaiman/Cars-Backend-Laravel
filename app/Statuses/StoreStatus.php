<?php

namespace App\Statuses;

class StoreStatus
{
    public const OFFICE = 'office';

    public const GALLERY = 'gallery';

    public static array $statuses = [self::OFFICE, self::GALLERY];
}
