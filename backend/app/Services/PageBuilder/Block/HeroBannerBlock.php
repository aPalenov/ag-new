<?php

namespace App\Services\PageBuilder\Block;

use App\Data\PageBuilder\Block\HeroBanner\HeroBannerData;
use Spatie\LaravelData\Data;

class HeroBannerBlock
{
    public function viewData(): ?Data
    {
        $images = [
            'https://www.avtogermes.ru/images/promo/xl/moskvich-s-gospodderzhkoj.5651d3232f006b8edc9930a9f4ca3058.jpg',
            'https://www.avtogermes.ru/images/promo/xl/avtomobili-bestune.ec1bb781e72e58224f02c4f271bae678.jpg',
            'https://www.avtogermes.ru/images/promo/xl/xcite-x-cross-8-s-vygodoj-do-850-000-banner-xl.786e490cd02cef538fde2a6bc3cf7991.jpg',
        ];

        return HeroBannerData::from([
            'items' => collect($images)
                ->map(
                    fn($image) => [
                        'title' => 'Каждый баннер содержит заголовок',
                        'subtitle' =>
                            'Описание баннера может занимать несколько строк и содержать полезную информацию для клиента',
                        'cta' => [
                            'label' => 'Получить предложение',
                            'url' => '#',
                        ],
                        'backgroundImageXl' => $image,
                        'secondCta' => [
                            'label' => 'Подробнее',
                            'url' => '#',
                        ],
                        'advertisingMarking' => [
                            'label' => 'ООО «АвтоГЕРМЕС-Запад»',
                            'erid' => '2SDnjbspBT5',
                            'url' => 'https://www.avtogermes.ru/sale/soueast/?erid=2SDnjbspBT5',
                        ],
                    ],
                )
                ->toArray(),
        ]);
    }
}
