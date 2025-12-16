<?php

namespace App\Data\PageBuilder\Block\Model;

use App\Data\PageBuilder\Block\Model\Tth\TthFirstData;
use App\Data\PageBuilder\Block\Model\Tth\TthSecondData;
use App\Data\PageBuilder\Color\ColorData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ModelData extends Data
{
    public function __construct(
        public string $model_name,

        public string $preview,

        public int $price_from,

        public Optional|int $credit_payment_per_month,

        public bool $trade_in,

        /** @var ColorData[] */
        public array $colors,

        /** @var TthFirstData[] */
        public array $first_tth,

        /** @var TthSecondData[] */
        public array $second_tth,
    ) {}
}
