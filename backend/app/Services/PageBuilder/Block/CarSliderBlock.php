<?php

namespace App\Services\PageBuilder\Block;

use App\Data\PageBuilder\Block\CarSlider\CarSliderData;
use Spatie\LaravelData\Data;

class CarSliderBlock
{
    public function viewData(): ?Data
    {
        return CarSliderData::from([
            'tabs' => [
                [
                    'type' => 'new',
                    'label' => 'Новые',
                    'title' => 'Новые автомобили TENET в наличии',
                    'cta' => ['label' => 'Все автомобили', 'url' => '#'],
                    'items' => collect(range(0, 8))->map(
                        fn($i) => [
                            'preview' =>
                                'https://www.avtogermes.ru/images/marks/tenet/t4/i/colors/st/tenet-t4-i-seryj-metallik.e981eeadf9d1beff37fd62ffd7d1bb40.png',
                            'type' => ['new', 'second'][rand(0, 1)],
                            'mark' => 'TENET',
                            'model' => 'T4',
                            'complectation' => 'Active',
                            'modification' => '2025 г., МКПП , 1.5 л (113 л.с), Бензиновый, Передний привод',
                            'color' => ['name' => 'Темно-серый', 'hex' => '#4C4C51'],
                            'features' => ['в наличии', 'c ПТС'],
                            'price' => 2200000,
                            'benefit' => 700000,
                            'cta' => [
                                'label' => 'Получить предложение #' . $i,
                                'url' => '#',
                            ],
                            'secondCta' => [
                                'label' => 'Записаться на тест-драйв',
                                'url' => '#',
                            ],
                        ],
                    ),
                ],
                [
                    'type' => 'second',
                    'label' => 'С пробегом',
                    'title' => 'Автомобили TENET c пробегом в наличии',
                    'cta' => ['label' => 'Все автомобили', 'url' => '#1'],
                    'items' => collect(range(0, 8))->map(
                        fn($i) => [
                            'preview' =>
                                'https://www.avtogermes.ru/images/second_cars/LVVDB21BXMD125020/chery-tiggo-7-pro-i.35e4f46b94157cb225f0dbbf9de88b82.jpg',
                            'type' => ['new', 'second'][rand(0, 1)],
                            'mark' => 'TENET',
                            'model' => 'T5',
                            'complectation' => 'Active',
                            'modification' => '2025 г., МКПП , 1.5 л (113 л.с), Бензиновый, Передний привод',
                            'color' => ['name' => 'Красненький', 'hex' => '#e35b55'],
                            'price' => 2200000,
                            'benefit' => 100000,
                            'cta' => [
                                'label' => 'Получить предложение #' . $i,
                                'url' => '#',
                            ],
                            'secondCta' => [
                                'label' => 'Записаться на тест-драйв',
                                'url' => '#',
                            ],
                        ],
                    ),
                ],
            ],
        ]);
    }
}
