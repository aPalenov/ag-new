<?php

namespace App\Data\PageBuilder\Block\ComplectationsTable;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ComplectationPricesData extends Data
{
    public function __construct(
        public int $price,

        public int $price_min,

        public string $price_text,

        public string $price_text_short,

        public int $show_price,

        public int $price_discount_max,

        public int $price_discount_credit,

        public int $price_discount_trade_in,

        public int $price_discount_direct,
    ) {}
}
