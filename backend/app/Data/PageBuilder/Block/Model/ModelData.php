<?php

namespace App\Data\PageBuilder\Block\Model;

use App\Data\PageBuilder\Color\ColorData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ModelData extends Data
{
    public function __construct(
        public string $title,

        public string $preview,

        public Optional|array $images_360,

        public int $price_from,

        public Optional|int $credit_payment_per_month,

        public bool $trade_in,

        /** @var ColorData[] */
        public array $colors,
    ) {}
}
