<?php

namespace App\Data\PageBuilder\Block\ModelSlider;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ModelSliderData extends Data
{
    public function __construct(
        public string $title,

        /** @var ModelSliderItemData[] */
        public array $items,
    ) {}
}
