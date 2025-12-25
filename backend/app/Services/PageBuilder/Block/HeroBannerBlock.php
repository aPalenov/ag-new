<?php

namespace App\Services\PageBuilder\Block;

use App\Data\PageBuilder\Block\HeroBanner\HeroBannerData;
use Spatie\LaravelData\Data;

class HeroBannerBlock
{
    public function viewData(): ?Data
    {
        $images = [
            [
                'xs' =>
                    'https://www.avtogermes.ru/images/promo/xs/solaris-hc-ot-1-808-000-s-vygodoj-do-600-000.187b689b2354078765efe40844463827_w530.jpg',
                'xl' =>
                    'https://www.avtogermes.ru/images/promo/xl/lada-s-gosudarstvennoj-podderzhkoj.fd858a50878c86268fb08b7d71124d1f.jpg',
            ],
            [
                'xs' =>
                    'https://www.avtogermes.ru/images/promo/xs/moskvich-s-gospodderzhkoj.840ca7049ba94df53ee72088f0150611_w530.jpg',
                'xl' =>
                    'https://www.avtogermes.ru/images/promo/xl/solaris-hc-ot-1-808-000-s-vygodoj-do-600-000.b195c9263a66fe6edf6bfd8d4fb09e28.jpg',
            ],
            [
                'xs' =>
                    'https://www.avtogermes.ru/images/promo/xs/lada-s-gosudarstvennoj-podderzhkoj.dc8c18fd814fb6661ddf9b77aacd2280_w530.jpg',
                'xl' =>
                    'https://www.avtogermes.ru/images/promo/xl/lada-s-gosudarstvennoj-podderzhkoj.fd858a50878c86268fb08b7d71124d1f.jpg',
            ],
        ];

        return HeroBannerData::from([
            'items' => collect($images)
                ->map(
                    fn($image) => [
                        'title' => 'Каждый баннер содержит заголовок',
                        'subtitle' => 'Каждый баннер содержит заголовок',
                        'cta' => [
                            'label' => 'Получить предложение',
                            'url' => '#',
                        ],
                        'backgroundImageXs' => $image['xs'],
                        'backgroundImageXl' => $image['xl'],
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
