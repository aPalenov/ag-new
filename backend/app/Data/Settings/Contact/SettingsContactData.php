<?php

namespace App\Data\Settings\Contact;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SettingsContactData extends Data
{
    public function __construct(
        public string $phone,

        // prettier-ignore
        /** @var DataCollection<SettingsContactLocationData> */
        public DataCollection $locations,
    ) {}
}
