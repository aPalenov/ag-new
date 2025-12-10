<?php

namespace App\Data\Shared;

use App\Data\Settings\Contact\SettingsContactData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SharedSettingsData extends Data
{
    public function __construct(
        // prettier-ignore
        public SettingsContactData $contact,
    ) {}
}
