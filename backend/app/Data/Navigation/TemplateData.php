<?php

namespace App\Data\Navigation;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use App\Data\Navigation\Templates\NavigationCarSelectionDefaultTemplateData;

#[TypeScript]
class TemplateData extends Data
{
    public function __construct(
        public string $name,

        public Optional|NavigationCarSelectionDefaultTemplateData $props,
    ) {}
}
