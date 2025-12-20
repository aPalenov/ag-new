<?php

namespace App\Data\PageBuilder\Block\MapContacts;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class MapContactsItemData extends Data
{
    public function __construct(
        public string $label,

        // prettier-ignore
        #[LiteralTypeScriptType('[number, number]')]
        public array $coordinates,
    ) {}
}
