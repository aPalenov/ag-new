<?php

namespace App\Data\PageBuilder\Block\AsideList;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class AsideListItemData extends Data
{
    public function __construct(
        public string $title,

        public string $description,

        public string $url,
    ) {}
}
