<?php

namespace App\Data\PageBuilder\Block\FeatureSlider;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class FeatureSliderItemData extends Data
{
    public function __construct(
        public string $title,

        public Optional|string $description,

        public Optional|string $icon,

        public Optional|string $url,
    ) {}
}
