<?php

namespace App\Data\Seo;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class MetaData extends Data
{
    public function __construct(
        public string $title,

        public string $description,
    ) {}
}
