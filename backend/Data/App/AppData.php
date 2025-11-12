<?php

namespace App\Data\App;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class AppData extends Data
{
    public function __construct(
        public string $baseUrl,

        public string $serverTime,
    ) {}
}
