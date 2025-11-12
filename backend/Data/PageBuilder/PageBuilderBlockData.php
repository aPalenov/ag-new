<?php

namespace App\Data\PageBuilder;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PageBuilderBlockData extends Data
{
    public function __construct(
        // prettier-ignore
        public string $name,

        public ?Data $data,
    ) {}
}
