<?php

namespace App\Statuses;

class ProductStatus
{
    // Product types
    public const TYPE_USED = 'used';

    public const TYPE_NEW = 'new';

    // Gear types
    public const GEARS_MANUAL = 'manual';

    public const GEARS_AUTOMATIC = 'automatic';

    // Drive types
    public const DRIVE_FRONT = 'front';

    public const DRIVE_REAR = 'rear';

    public const DRIVE_4x4 = '4x4';

    // Fuel types
    public const FUEL_PETROL = 'petrol';

    public const FUEL_DIESEL = 'diesel';

    public const FUEL_HYBRID = 'hybrid';

    public const FUEL_ELECTRIC = 'electric';

    // Seat types
    public const SEAT_LEATHER = 'leather';

    public const SEAT_CLOTH = 'cloth';

    // Sunroof options
    public const SUNROOF_YES = true;

    public const SUNROOF_NO = false;

    // Product offer status
    public const OFFER_AVAILABLE = true;

    public const OFFER_NOT_AVAILABLE = false;

    // Product status array for validation or dropdowns
    public static array $statuses = [
        self::TYPE_USED,
        self::TYPE_NEW,
        self::GEARS_MANUAL,
        self::GEARS_AUTOMATIC,
        self::DRIVE_FRONT,
        self::DRIVE_REAR,
        self::FUEL_PETROL,
        self::FUEL_DIESEL,
        self::FUEL_ELECTRIC,
        self::FUEL_HYBRID,
        self::SEAT_LEATHER,
        self::SEAT_CLOTH,
        self::SUNROOF_YES,
        self::SUNROOF_NO,
        self::OFFER_AVAILABLE,
        self::OFFER_NOT_AVAILABLE,
    ];
}
