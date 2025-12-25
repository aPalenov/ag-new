<?php

namespace App\Data\PageBuilder\Block\StaggeredContent;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class StaggeredContentRowData extends Data
{
    public function __construct(
        public string $image,

        public Optional|string $title,

        public string $text,
    ) {}
}
