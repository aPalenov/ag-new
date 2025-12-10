<?php

namespace App\Data\Settings\Contact;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SettingsContactLocationData extends Data
{
    public function __construct(
        public string $label,

        // prettier-ignore
        #[LiteralTypeScriptType('[number, number]')]
        public array $coordinates,
    ) {}
}
