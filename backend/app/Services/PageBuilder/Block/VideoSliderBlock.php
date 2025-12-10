<?php

namespace App\Services\PageBuilder\Block;

use App\Data\PageBuilder\Block\VideoSlider\VideoSliderData;
use App\Data\PageBuilder\Block\VideoSlider\VideoSliderItemData;
use App\Data\PageBuilder\Block\VideoSlider\VideoSliderCtaData;
use Spatie\LaravelData\Data;

class VideoSliderBlock
{
    public function viewData(): ?Data
    {
        return VideoSliderData::from([
            'title' => 'Видеообзоры',
            'cta' => [
                'label' => 'Все видеобзоры',
                'url' => '#',
            ],
            'items' => collect(range(0, 5))->map(
                fn() => [
                    'preview' =>
                        'https://www.avtogermes.ru/images/promo/card/tenet-t4-s-vygodoj-do-878-000.f2267106231b9c0281bc8fbb7c1a7137.jpg',
                    'title' => 'Коробки передач: виды, преимущества и недостатки',
                    'publishedAt' => now()->toISOString(),
                    'url' => '#',
                ],
            ),
        ]);
    }
}
