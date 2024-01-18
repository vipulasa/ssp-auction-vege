<?php
namespace App\Enums;

enum Role: int
{
    case SuperAdministrator = 1;
    case Moderator = 2;
    case FarmerManager = 3;
    case MarketingManager = 4;
    case SalesManager = 5;
    case AuctionManager = 6;
    case Customer = 7;
}
