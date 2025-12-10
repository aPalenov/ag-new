<?php

namespace App\Data\PageBuilder\Block\CarSlider;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class CarSliderData extends Data
{
    public function __construct(
        /** @var CarSliderTabData[] */
        public array $tabs,
    ) {}
}
