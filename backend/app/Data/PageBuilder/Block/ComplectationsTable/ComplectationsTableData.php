<?php

namespace App\Data\PageBuilder\Block\ComplectationsTable;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ComplectationsTableData extends Data
{
    public function __construct(
        public string $title,

        /** @var array<string> */
        public array $filter_keys,

        /** @var ComplectationItemData[] */
        public array $complectations,

        public ComplectationsOptionsData $options,
    ) {}
}
