<?php

namespace App\Data\Seo;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SeoContentData extends Data
{
    public function __construct(
        public string $title = '',

        public ?string $text = null,

        public MetaData $meta = new MetaData(title: '', description: ''),
    ) {}
}
