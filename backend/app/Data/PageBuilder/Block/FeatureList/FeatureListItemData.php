<?php

namespace App\Data\PageBuilder\Block\FeatureList;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class FeatureListItemData extends Data
{
    public function __construct(
        public string $type,

        public string $title,

        public Optional|string $description,
    ) {}
}
