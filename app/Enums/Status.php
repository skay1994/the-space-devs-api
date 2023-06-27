<?php

namespace App\Enums;

enum Status: int
{
    case GO = 1;
    case TBD = 2;
    case SUCCESS = 3;
    case FAILURE = 4;
    case HOLD = 5;
    case LAUNCH_FLIGHT = 6;
    case PARTIAL_FAILURE = 7;

    public function name(): string
    {
        return match ($this) {
            self::GO => trans('Go for Launch'),
            self::TBD => trans('To Be Confirmed'),
            self::SUCCESS => trans('Success'),
            self::FAILURE => trans('Failed'),
            self::HOLD => trans('Hold'),
            self::LAUNCH_FLIGHT => trans('Launch on Flight'),
            self::PARTIAL_FAILURE => trans('Launch was a Partial Failure'),
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
