<?php

namespace App\Casts\Data;

use App\Services\Content\Tags\TagManager;
use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class RichContentCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        if ($value === null) {
            return '';
        }

        return RichContentRenderer::make(trim((string) $value))
            ->mergeTags(app(TagManager::class)->all())
            ->toHtml();
    }
}
