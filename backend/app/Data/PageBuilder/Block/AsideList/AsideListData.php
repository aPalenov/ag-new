<?php

namespace App\Data\PageBuilder\Block\AsideList;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class AsideListData extends Data
{
    public function __construct(
        public string $title,

        public string $photo,

        /** @var AsideListItemData[] */
        public array $items,
    ) {}
}
