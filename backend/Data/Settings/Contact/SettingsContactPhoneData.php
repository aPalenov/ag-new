<?php

namespace App\Data\Settings\Contact;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SettingsContactPhoneData extends Data
{
    public function __construct(
        public string $link,

        public string $name,
    ) {}
}
