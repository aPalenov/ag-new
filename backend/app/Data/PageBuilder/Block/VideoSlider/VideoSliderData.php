<?php

namespace App\Data\PageBuilder\Block\VideoSlider;

use App\Data\PageBuilder\Cta\CtaData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class VideoSliderData extends Data
{
    public function __construct(
        public string $title,

        public CtaData $cta,

        /** @var VideoSliderItemData[] */
        public array $items,
    ) {}
}
