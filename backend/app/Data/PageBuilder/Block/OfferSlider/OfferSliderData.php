<?php

namespace App\Data\PageBuilder\Block\OfferSlider;

use App\Data\PageBuilder\Cta\CtaData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class OfferSliderData extends Data
{
    public function __construct(
        public string $title,

        public CtaData $cta,

        /** @var OfferSliderItemData[] */
        public array $items,
    ) {}
}
