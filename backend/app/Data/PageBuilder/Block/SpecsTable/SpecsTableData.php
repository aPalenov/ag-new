<?php

namespace App\Data\PageBuilder\Block\SpecsTable;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SpecsTableData extends Data
{
    public function __construct(
        public Optional|string $title,

        public Optional|int $opened_index,

        /** @var SpecsTableGroupData[] */
        public array $groups,
    ) {}
}
