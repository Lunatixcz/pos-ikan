<?php

namespace App\Enums;

enum CategoryType: string
{
    case Type1 = 'type1';
    case Type2 = 'type2';
    case Type3 = 'type3';

    public static function getDisplayNames(): array
    {
        return [
            self::Type1->value => 'Type 1',
            self::Type2->value => 'Type 2',
            self::Type3->value => 'Type 3',
        ];
    }
}
