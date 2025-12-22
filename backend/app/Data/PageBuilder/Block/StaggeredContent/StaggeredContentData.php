<?php

namespace App\Data\PageBuilder\Block\StaggeredContent;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class StaggeredContentData extends Data
{
    public function __construct(
        public string $title,

        /** @var StaggeredContentRowData[] */
        public array $rows,
    ) {}
}
