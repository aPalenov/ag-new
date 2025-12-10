<?php

namespace App\Data\PageBuilder\Block\Text;

use App\Data\PageBuilder\Cta\CtaData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class TextData extends Data
{
    public function __construct(
        public string $title,

        public int $columns,

        public string $text,

        public CtaData $cta,
    ) {}
}
