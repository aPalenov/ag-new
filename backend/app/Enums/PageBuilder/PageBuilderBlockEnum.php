<?php

namespace App\Enums\PageBuilder;

use App\Enums\Concerns\EnumTrait;
use App\Enums\MetaProperties\Description;
use ArchTech\Enums\Meta\Meta;

#[Meta(Description::class)]
enum PageBuilderBlockEnum: string
{
    use EnumTrait;

    // Home
    #[Description('Главный баннер')]
    case HeroBanner = 'HeroBanner';

    #[Description('Слайдер моделей')]
    case ModelSlider = 'ModelSlider';

    #[Description('Текстовый блок')]
    case Text = 'Text';

    #[Description('Слайдер предложений')]
    case OfferSlider = 'OfferSlider';

    #[Description('Слайдер видео')]
    case VideoSlider = 'VideoSlider';

    #[Description('Список преимуществ')]
    case FeatureList = 'FeatureList';

    #[Description('Слайдер автомобилей')]
    case CarSlider = 'CarSlider';

    #[Description('Список в сайдбаре')]
    case AsideList = 'AsideList';

    #[Description('Слайдер преимуществ')]
    case FeatureSlider = 'FeatureSlider';

    #[Description('Карта')]
    case Map = 'Map';

    // Models

    #[Description('Список моделей')]
    case ModelList = 'ModelList';

    #[Description('Модель')]
    case Model = 'Model';

    #[Description('Т.Х. коротко')]
    case SpecsShort = 'SpecsShort';

    #[Description('Т.Х. таблица')]
    case SpecsTable = 'SpecsTable';

}
