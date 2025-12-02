<?php

namespace App\Casts\Data;

use App\Data\Link\LinkData;
use App\Services\Link\LinkService;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class LinkCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        if ($value['type'] === null) {
            return null;
        }

        $value['href'] ??= app(LinkService::class)->href($value);

        return LinkData::from(array_filter($value, fn($v) => $v !== null));
    }
}
