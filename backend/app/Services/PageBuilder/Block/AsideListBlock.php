<?php

namespace App\Services\PageBuilder\Block;

use App\Data\PageBuilder\Block\AsideList\AsideListData;
use Spatie\LaravelData\Data;

class AsideListBlock
{
    public function viewData(): ?Data
    {
        return AsideListData::from([
            'title' => 'Дополнительные услуги',
            'photo' =>
                'https://www.avtogermes.ru/images/promo/xl/tenet-t8-s-vygodoj-do-900-000.97a1abcfa43d2b3cc4002e50ea5632d6.jpg',
            'items' => [
                [
                    'title' => 'Услуга 1',
                    'description' => 'оборудование и материалы при обслуживании автомобилей',
                    'url' => '#',
                ],
                [
                    'title' => 'Услуга 2',
                    'description' =>
                        'оборудование и материалы при обслуживании автомобилей, оборудование и материалы при обслуживании автомобилей',
                    'url' => '#',
                ],
                [
                    'title' => 'Услуга 3',
                    'description' => 'оборудование и материалы при обслуживании автомобилей',
                    'url' => '#',
                ],
            ],
        ]);
    }
}
