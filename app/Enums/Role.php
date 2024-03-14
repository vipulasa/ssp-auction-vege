<?php

namespace App\Enums;

/**
 * Class Role
 * @package App\Enums
 */
enum Role: int
{
    case SuperAdministrator = 1;
    case Moderator = 2;
    case FarmerManager = 3;
    case MarketingManager = 4;
    case SalesManager = 5;
    case AuctionManager = 6;
    case Customer = 7;

    /**
     * @param int $value
     * @return self|null
     */
    public static function fromValue(int $value): ?self
    {
        return match ($value) {
            1 => self::SuperAdministrator,
            2 => self::Moderator,
            3 => self::FarmerManager,
            4 => self::MarketingManager,
            5 => self::SalesManager,
            6 => self::AuctionManager,
            7 => self::Customer,
            default => null,
        };
    }

    /**
     * @param string $key
     * @return self|null
     */
    public static function fromKey(string $key): ?self
    {
        return match ($key) {
            'SuperAdministrator' => self::SuperAdministrator,
            'Moderator' => self::Moderator,
            'FarmerManager' => self::FarmerManager,
            'MarketingManager' => self::MarketingManager,
            'SalesManager' => self::SalesManager,
            'AuctionManager' => self::AuctionManager,
            'Customer' => self::Customer,
            default => null,
        };
    }
}
