<?php

namespace App\Enums\Link;

use App\Enums\Concerns\EnumTrait;
use App\Enums\MetaProperties\Description;
use ArchTech\Enums\Meta\Meta;

#[Meta(Description::class)]
enum LinkTargetEnum: string
{
    use EnumTrait;

    #[Description('Same tab')]
    case SELF = '';

    #[Description('New tab')]
    case BLANK = '_blank';

    public static function options(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = $case->description();
        }

        return $options;
    }
}
