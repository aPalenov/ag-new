<?php

namespace App\Data\Link;

use App\Enums\Link\LinkTargetEnum;
use App\Enums\Link\LinkTypeEnum;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class LinkData extends Data
{
    public function __construct(
        public Optional|LinkTypeEnum $type,

        public Optional|string $url,

        public string $href,

        public Optional|LinkTargetEnum $target,
    ) {}
}
