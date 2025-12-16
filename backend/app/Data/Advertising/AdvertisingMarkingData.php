<?php

namespace App\Data\Advertising;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class AdvertisingMarkingData extends Data
{
    public function __construct(
        public string $erid,

        public Optional|string $label,

        public Optional|string $url,

        public bool $dark = false,
    ) {}
}
