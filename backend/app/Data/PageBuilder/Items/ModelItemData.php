<?php

namespace App\Data\PageBuilder\Items;

use App\Data\PageBuilder\Color\ColorData;
use App\Data\PageBuilder\Cta\CtaData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ModelItemData extends Data
{
    public function __construct(
        public string $mark,

        public string $model,

        public string $subtitle,

        public int $count,

        /** @var ColorData[] */
        public array $colors,

        public CtaData $cta,

        public string $preview,

        public int $price,

        public int $benefit,
    ) {}
}
