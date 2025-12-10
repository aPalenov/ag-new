<?php

namespace App\Services\PageBuilder\Block;

use App\Data\PageBuilder\Block\OfferSlider\OfferSliderData;
use Spatie\LaravelData\Data;

class OfferSliderBlock
{
    public function viewData(): ?Data
    {
        return OfferSliderData::from([
            'title' => 'Новости и спецпредложения',
            'cta' => [
                'label' => 'Все новости',
                'url' => '#',
            ],
            'items' => collect(range(0, 5))->map(
                fn() => [
                    'preview' =>
                        'https://www.avtogermes.ru/images/promo/card/tenet-t4-s-vygodoj-do-878-000.f2267106231b9c0281bc8fbb7c1a7137.jpg',
                    'type' => ['news', 'offer'][rand(0, 1)],
                    'title' => 'Коробки передач: виды, преимущества',
                    'description' => ['Коробки передач: виды, преимущества и недостатки', 'Коробки передач'][
                        rand(0, 1)
                    ],
                    'publishedAt' => now()->toISOString(),
                    'cta' => [
                        'label' => 'Подробнее',
                        'url' => '#',
                    ],
                ],
            ),
        ]);
    }
}
