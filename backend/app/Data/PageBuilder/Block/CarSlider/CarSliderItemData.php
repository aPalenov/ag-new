<?php

namespace App\Data\PageBuilder\Block\CarSlider;

use App\Data\PageBuilder\Color\ColorData;
use App\Data\PageBuilder\Cta\CtaData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class CarSliderItemData extends Data
{
    public function __construct(
        public string $preview,

        public string $type,

        public string $mark,

        public string $model,

        public string $complectation,

        public string $modification,

        public ColorData $color,

        /** @var array<string> */
        public Optional|array $features,

        public int $price,

        public int $benefit,

        public CtaData $cta,

        public CtaData $secondCta,
    ) {}
}
