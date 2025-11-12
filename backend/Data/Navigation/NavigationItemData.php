<?php

namespace App\Data\Navigation;

use App\Data\Link\LinkData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class NavigationItemData extends Data
{
    public function __construct(
        public string $label,

        public ?LinkData $data,

        public Optional|string $classes,

        /** @var NavigationItemData[] */
        public array $children,
    ) {}
}
