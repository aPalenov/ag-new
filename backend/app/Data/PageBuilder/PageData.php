<?php

namespace App\Data\PageBuilder;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PageData extends Data
{
    public function __construct(
        /** @var PageBuilderBlockData[] */
        public Optional|array $pageBuilderData,
    ) {}
}
