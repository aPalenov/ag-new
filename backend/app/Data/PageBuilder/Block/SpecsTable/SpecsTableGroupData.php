<?php

declare(strict_types=1);

namespace App\Data\PageBuilder\Block\SpecsTable;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SpecsTableGroupData extends Data
{
    public function __construct(
        public string $label,

        /** @var SpecsTableRowData[] */
        public array $rows,
    ) {}
}
