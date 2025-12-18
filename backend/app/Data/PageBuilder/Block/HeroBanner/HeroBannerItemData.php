<?php

namespace App\Data\PageBuilder\Block\HeroBanner;

use App\Data\Advertising\AdvertisingMarkingData;
use App\Data\PageBuilder\Cta\CtaData;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class HeroBannerItemData extends Data
{
    public function __construct(
        public string $title,

        public string $subtitle,

        public string $backgroundImageXs,

        public string $backgroundImageXl,

        public Optional|CtaData $cta,

        public Optional|CtaData $secondCta,

        public Optional|AdvertisingMarkingData $advertisingMarking,
    ) {}
}
