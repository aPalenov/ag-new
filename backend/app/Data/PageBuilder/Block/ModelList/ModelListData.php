<?php

namespace App\Data\PageBuilder\Block\ModelList;

use App\Data\PageBuilder\Items\ModelItemData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ModelListData extends Data
{
    public function __construct(
        public string $title,

        /** @var ModelItemData[] */
        public array $items,
    ) {}
}
