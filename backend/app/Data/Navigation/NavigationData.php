<?php

namespace App\Data\Navigation;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class NavigationData extends Data
{
    public function __construct(
        /** @var NavigationItemData[] */
        public array $main,

        /** @var NavigationItemData[] */
        public array $footer,
    ) {}
}
