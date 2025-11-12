<?php

namespace App\Data\Breadcrumb;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class BreadcrumbItemData extends Data
{
    public function __construct(
        public string $title,

        public ?string $url,

        public bool $isActive,
    ) {}
}
