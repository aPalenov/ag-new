<?php

namespace App\Data\PageBuilder\Block\FeatureSlider;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class FeatureSliderData extends Data
{
    public function __construct(
        public int $columns,

        /** @var FeatureSliderItemData[] */
        public array $items,
    ) {}
}
