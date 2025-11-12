<?php

namespace App\Data\Settings\Contact;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SettingsContactData extends Data
{
    public function __construct(
        public SettingsContactPhoneData $phone,

        public string $whatsapp,

        public string $telegram,

        public string $email,

        public string $address,
    ) {}
}
