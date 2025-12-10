<?php

namespace App\Data\PageBuilder;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PageBuilderBlockData extends Data
{
    public function __construct(
        public string $name,

        public ?array $data,
    ) {}
}
