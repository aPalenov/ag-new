<?php

namespace App\Data\Link;

use App\Enums\Link\LinkTargetEnum;
use App\Enums\Link\LinkTypeEnum;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class LinkDatabaseData extends Data
{
    public function __construct(
        public ?LinkTypeEnum $type,

        public null|Optional|string $url,

        public null|Optional|LinkTargetEnum $target,

        public null|Optional|string $id,
    ) {}
}
