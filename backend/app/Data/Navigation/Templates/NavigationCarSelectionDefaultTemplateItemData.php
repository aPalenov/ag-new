<?php

namespace App\Data\Navigation\Templates;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class NavigationCarSelectionDefaultTemplateItemData extends Data
{
    public function __construct(
        public string $mark,

        public string $model,

        public int $price,
    ) {}
}
