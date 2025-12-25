<?php

namespace App\Data\PageBuilder\Block\ComplectationsTable;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ComplectationsOptionsData extends Data
{
    public function __construct(
        /** @var array<string, array<string, array<int, bool>>> */
        public array $compare,

        /** @var array<string, array<string>> */
        public array $base,
    ) {}
}
