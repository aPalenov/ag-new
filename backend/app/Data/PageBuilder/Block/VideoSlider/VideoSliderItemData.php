<?php

namespace App\Data\PageBuilder\Block\VideoSlider;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class VideoSliderItemData extends Data
{
    public function __construct(
        public string $preview,

        public string $title,

        public string $publishedAt,

        public string $url,
    ) {}
}
