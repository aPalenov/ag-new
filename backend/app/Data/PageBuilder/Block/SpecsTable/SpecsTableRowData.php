<?php

namespace App\Data\PageBuilder\Block\SpecsTable;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SpecsTableRowData extends Data
{
    public function __construct(
        public string $label,

        /** @var string[] */
        public array $items,
    ) {}
}
