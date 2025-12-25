<?php

namespace App\Data\Navigation;

use App\Data\Link\LinkData;
use App\Data\Navigation\TemplateData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class NavigationItemData extends Data
{
    public function __construct(
        public string $label,

        public Optional|string $name,

        public Optional|LinkData $data,

        public Optional|string $classes,

        public Optional|TemplateData $template,

        /** @var NavigationItemData[] */
        public array $children,
    ) {}
}
