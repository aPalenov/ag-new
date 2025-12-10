<?php

namespace App\Data\PageBuilder;

use App\Data\Seo\MetaData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ErrorPageData extends Data
{
    public function __construct(
        public int $status,

        public Optional|MetaData $meta,
    ) {}
}
