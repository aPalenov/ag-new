<?php

namespace App\Data\PageBuilder\Block\ComplectationsTable;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ComplectationItemData extends Data
{
    public function __construct(
        public int $id,

        public string $name,

        public string $full_name,

        public string $year,

        /** @var array<string> */
        public array $codes,

        public ComplectationPricesData $prices,

        public int $cars_count,

        public int $seats,

        public bool $isImport,

        public string $transmission_type,

        public string $engine_url,

        public string $engine_volume,

        public string $transmission,

        public string $engine_power,

        public string $engine_type,

        public string $drive,

        public string $transmission_short,

        public string $url,

        public string $engine_label,

        public string $seat_label,
    ) {}
}
