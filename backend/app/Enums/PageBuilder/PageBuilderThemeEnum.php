<?php

namespace App\Enums\PageBuilder;

use App\Enums\Concerns\EnumTrait;
use App\Enums\MetaProperties\Description;
use ArchTech\Enums\Meta\Meta;

#[Meta(Description::class)]
enum PageBuilderThemeEnum: string
{
    use EnumTrait;

    #[Description('Тема по умолчанию')]
    case ThemeDefault = 'theme-default';
}
