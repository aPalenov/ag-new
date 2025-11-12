<?php

namespace App\Data\PageBuilder\Block\BlockContent;

use App\Casts\Data\RichContentCast;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class BlockContentData extends Data
{
    public function __construct(
        // prettier-ignore
        #[WithCast(RichContentCast::class)]
        public string $text,
    ) {}
}
