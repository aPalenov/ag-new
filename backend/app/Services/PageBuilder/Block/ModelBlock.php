<?php

namespace App\Services\PageBuilder\Block;

use App\Data\PageBuilder\Block\Model\ModelData;
use Spatie\LaravelData\Data;

class ModelBlock
{
    public function viewData(): ?Data
    {
        return ModelData::from([
            'model_name' => 'TENET T4',
            'preview' =>
                'https://www.avtogermes.ru/images/marks/tenet/t4/i/colors/st/tenet-t4-i-seryj-metallik.e981eeadf9d1beff37fd62ffd7d1bb40.png',
            'price_from' => 2200000,
            'credit_payment_per_month' => 12000,
            'trade_in' => true,
            'colors' => [
                ['name' => 'Технологичный серый', 'hex' => '#9b9b9b', 'id' => 1],
                ['name' => 'Искрящийся белый', 'hex' => '#ffffff', 'id' => 3],
                ['name' => 'Огненно-красный', 'hex' => '#d0021b', 'id' => 2],
                ['name' => 'Глубокий черный', 'hex' => '#000000', 'id' => 4],
                ['name' => 'Gray B', 'hex' => '#bbb', 'id' => 5],
                ['name' => 'Blue Sky', 'hex' => '#87ceeb', 'id' => 6],
                ['name' => 'Sunset Orange', 'hex' => '#ff4500', 'id' => 7],
                ['name' => 'Forest Green', 'hex' => '#228b22', 'id' => 8],
            ],
            'first_tth' => [
                [
                    'icon' => 'ag:engine',
                    'label' => 'Двигатель',
                    'value' => '1.6 л',
                ],
                [
                    'icon' => 'ag:power',
                    'label' => 'Мощность',
                    'value' => '147 л.с.',
                ],
                [
                    'icon' => 'ag:gearbox',
                    'label' => 'КПП',
                    'value' => '5DCT',
                ],
                [
                    'icon' => 'ag:engine',
                    'label' => 'Двигатель',
                    'value' => '1.6 л',
                ],
            ],
            'second_tth' => [
                [
                    'label' => 'Ширина',
                    'value' => '1 725 мм',
                ],
                [
                    'label' => 'Высота',
                    'value' => '1 490 мм',
                ],
                [
                    'label' => 'Длина',
                    'value' => '4 390 мм',
                ],
                [
                    'label' => 'Колёсная база',
                    'value' => '2 535 мм',
                ],
            ],
        ]);
    }
}
