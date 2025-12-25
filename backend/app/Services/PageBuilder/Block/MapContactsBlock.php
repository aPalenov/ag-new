<?php

namespace App\Services\PageBuilder\Block;

use App\Data\PageBuilder\Block\MapContacts\MapContactsData;
use Spatie\LaravelData\Data;

class MapContactsBlock
{
    public function viewData(): ?Data
    {
        return MapContactsData::from([
            'title' => 'Контакты',
            'center' => [37.573, 55.751],
            'zoom' => 10,
            'items' => [
                [
                    'label' => 'г. Москва, Дмитровское ш., д. 161А',
                    'coordinates' => [37.53913, 55.90665],
                ],
                [
                    'label' => 'г. Москва, МКАД 44 км, д. 1',
                    'coordinates' => [37.46578, 55.63249],
                ],
                [
                    'label' => 'г. Москва, Рязанский пр-т, д. 2, с. 27',
                    'coordinates' => [37.74445, 55.72959],
                ],
            ],
        ]);
    }
}
