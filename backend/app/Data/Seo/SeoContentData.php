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

    /**
     * Create from raw AI response array with flexible keys.
     */
    public static function fromAi(array $payload): self
    {
        $title = (string) (data_get($payload, 'title') ?? '');
        $text = data_get($payload, 'text');

        $metaTitle = (string) (data_get($payload, 'meta.title') ?? (data_get($payload, 'meta_title') ?? ''));
        $metaDescription =
            (string) (data_get($payload, 'meta.description') ?? (data_get($payload, 'meta_description') ?? ''));

        return new self(
            title: $title,
            text: is_string($text) ? $text : null,
            meta: new MetaData(title: $metaTitle, description: $metaDescription),
        );
    }
}
