<?php

namespace App\Services\PageBuilder\Block;

use App\Data\PageBuilder\Block\ModelList\ModelListData;
use Spatie\LaravelData\Data;

class ModelListBlock
{
    public function viewData(): ?Data
    {
        return ModelListData::from([
            'title' => 'Официальный дилер TENET в Москве',
            'items' => collect(range(0, 5))->map(
                fn($i) => [
                    'mark' => 'TENET',
                    'model' => 'T4',
                    'subtitle' => 'Семейный компактный кроссовер #' . $i,
                    'count' => rand(1, 10),
                    'colors' => [
                        ['name' => 'Gray', 'hex' => '#111', 'id' => 1],
                        ['name' => 'Gray 3', 'hex' => '#333', 'id' => 2],
                        ['name' => 'Gray 5', 'hex' => '#555', 'id' => 3],
                        ['name' => 'Gray 7', 'hex' => '#777', 'id' => 4],
                        ['name' => 'Gray 9', 'hex' => '#999', 'id' => 5],
                        ['name' => 'Gray B', 'hex' => '#bbb', 'id' => 6],
                    ],
                    'cta' => [
                        'label' => 'Подробнее',
                        'url' => '/models/tenet-t4',
                    ],
                    'preview' =>
                        'https://www.avtogermes.ru/images/marks/tenet/t4/i/colors/st/tenet-t4-i-seryj-metallik.e981eeadf9d1beff37fd62ffd7d1bb40.png',
                    'price' => 2200000,
                    'benefit' => 2200000,
                ],
            ),
        ]);
    }
}
