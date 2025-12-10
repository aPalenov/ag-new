<?php

namespace App\Data\PageBuilder\Block\CarSlider;

use App\Data\PageBuilder\Cta\CtaData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class CarSliderTabData extends Data
{
    public function __construct(
        public string $type,

        public string $label,

        public string $title,

        public CtaData $cta,

        /** @var CarSliderItemData[] */
        public array $items,
    ) {}
}
