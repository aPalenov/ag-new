<?php

namespace App\Casts\Data;

use Illuminate\Support\Str;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class MarkdownCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        if ($value === null) {
            return '';
        }

        return Str::markdown(nl2br(trim($value)));
    }
}
