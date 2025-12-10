<?php

namespace App\Services\PageBuilder\Block;

use App\Data\PageBuilder\Block\FeatureList\FeatureListData;
use Spatie\LaravelData\Data;

class FeatureListBlock
{
    public function viewData(): ?Data
    {
        return FeatureListData::from([
            'columns' => 3,
            'items' => [
                [
                    'type' => 'heading',
                    'title' => 'Преимущества компании АвтоГЕРМЕС',
                ],
                [
                    'type' => 'feature',
                    'title' => 'Порядочность',
                    'description' => 'обязательное выполнение всех своих обязательств перед клиентом',
                ],
                [
                    'type' => 'feature',
                    'title' => 'Профессионализм',
                    'description' => 'наши сотрудники действительно разбираются в машинах и любят свое дело',
                ],
                [
                    'type' => 'feature',
                    'title' => 'Качество',
                    'description' =>
                        'мы используем только высококачественное оборудование и материалы при обслуживании автомобилей',
                ],
                [
                    'type' => 'feature',
                    'title' => 'Дружелюбие',
                    'description' =>
                        'нам важно, чтобы каждый клиент был доволен нашей работой, чтобы хотел снова приехать к нам просто так без всякого повода',
                ],
                [
                    'type' => 'feature',
                    'title' => 'Надежность',
                    'description' =>
                        'наше гарантийное и пост-гарантийное обслуживание обеспечат отличное состояние Вашего автомобиля, а застраховав свой',
                ],
            ],
        ]);
    }
}
