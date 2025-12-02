<?php

namespace App\Enums\Link;

use App\Enums\Concerns\EnumTrait;
use App\Enums\MetaProperties\Description;
use ArchTech\Enums\Meta\Meta;

#[Meta(Description::class)]
enum LinkTypeEnum: string
{
    use EnumTrait;

    #[Description('External Link')]
    case EXTERNAL_LINK = 'external-link';

    #[Description('Internal Link')]
    case INTERNAL_LINK = 'internal-link';

    #[Description('Page')]
    case PAGE = 'page';
}
