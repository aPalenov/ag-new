<?php

namespace App\Services\PageBuilder\Block;

use App\Data\PageBuilder\Block\FeatureSlider\FeatureSliderData;
use Spatie\LaravelData\Data;

class FeatureSliderBlock
{
    public function viewData(): ?Data
    {
        return FeatureSliderData::from([
            'columns' => 4,
            'items' => [
                [
                    'icon' => 'ag:steering-wheel',
                    'title' => 'Запись на тест‑драйв',
                    'description' =>
                        'мы используем только высококачественное оборудование и материалы при обслуживании автомобилей',
                    'url' => '#',
                ],
                [
                    'icon' => 'ag:money',
                    'title' => 'Купить онлайн',
                    'description' =>
                        'мы используем только высококачественное оборудование и материалы при обслуживании автомобилей',
                    'url' => '#',
                ],
                [
                    'icon' => 'ag:service',
                    'title' => 'Запись на ТО',
                    'description' =>
                        'мы используем только высококачественное оборудование и материалы при обслуживании автомобилей',
                    'url' => '#',
                ],
                [
                    'icon' => 'ag:calc',
                    'title' => 'Запись на ТО',
                    'description' =>
                        'мы используем только высококачественное оборудование и материалы при обслуживании автомобилей',
                    'url' => '#',
                ],
            ],
        ]);
    }
}
