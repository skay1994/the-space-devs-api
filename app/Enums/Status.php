<?php

namespace App\Enums;

enum Status: string
{
    case DRAFT = 'draft';
    case TRASH = 'trash';
    case PUBLISHED = 'published';

    public function name(): string
    {
        return match ($this) {
            self::DRAFT => trans('Draft'),
            self::TRASH => trans('Trash'),
            self::PUBLISHED => trans('Published'),
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
