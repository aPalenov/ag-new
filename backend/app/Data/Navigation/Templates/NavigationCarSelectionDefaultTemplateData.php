<?php

namespace App\Data\Navigation\Templates;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class NavigationCarSelectionDefaultTemplateData extends Data
{
    public function __construct(
        public string $title,

        /** @var NavigationCarSelectionDefaultTemplateItemData[] */
        public array $items,
    ) {}
}
