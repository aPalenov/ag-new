<?php

namespace App\Data\PageBuilder\Block\FeatureList;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class FeatureListData extends Data
{
    public function __construct(
        public Optional|string $title,

        public int $columns,

        /** @var FeatureListItemData[] */
        public array $items,
    ) {}
}
