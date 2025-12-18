<?php

namespace App\Services\PageBuilder\Block;

use App\Data\PageBuilder\Block\SpecsShort\SpecsShortData;
use Spatie\LaravelData\Data;

class SpecsShortBlock
{
    public function viewData(): ?Data
    {
        return SpecsShortData::from([
            'title' => 'Технические характеристики TENET T4',
            'first_specs' => [
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
            'second_specs' => [
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
