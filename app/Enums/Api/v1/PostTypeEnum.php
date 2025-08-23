<?php

namespace App\Enums\Api\v1;

enum PostTypeEnum: string
{
    case ADOPTION = "adoption";
    case LOST = "lost";
    // case FOUND = "found";

    public static function toArray(): array
    {
        return array_column(PostTypeEnum::cases(), 'value');
    }
}
