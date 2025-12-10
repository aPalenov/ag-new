<?php

namespace App\Data\PageBuilder\Block\OfferSlider;

use App\Data\PageBuilder\Cta\CtaData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class OfferSliderItemData extends Data
{
    public function __construct(
        public string $preview,

        public string $type,

        public string $title,

        public string $description,

        public string $publishedAt,

        public CtaData $cta,
    ) {}
}
