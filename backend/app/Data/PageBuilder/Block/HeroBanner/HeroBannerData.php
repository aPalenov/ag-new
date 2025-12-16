<?php

namespace App\Data\PageBuilder\Block\HeroBanner;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class HeroBannerData extends Data
{
    public function __construct(
        /** @var HeroBannerItemData[] */
        public array $items,
    ) {}
}
