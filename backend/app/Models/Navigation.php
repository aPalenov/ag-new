<?php

namespace App\Models;

use App\Enums\Link\LinkTypeEnum;

class Navigation extends BaseModel
{
    /**
     * Get navigation trees by an array of handles.
     */
    public static function getTreesByHandles(array $handles): array
    {
        $result = [];
        foreach ($handles as $handle) {
            $result[$handle] = self::getTreeByHandle($handle);
        }

        return $result;
    }

    /**
     * Get a navigation tree by handle.
     */
    public static function getTreeByHandle(string $handle): array
    {
        return [
            'main' => [
                [
                    'label' => 'Главная',
                    'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/'],
                    'classes' => 'nav-item-home',
                    'children' => [],
                ],
                [
                    'label' => 'Модельный ряд',
                    'data' => null,
                    'children' => collect(['T4', 'T5', 'T6'])
                        ->map(
                            fn($m) => [
                                'label' => 'TENET ' . $m,
                                'data' => [
                                    'type' => LinkTypeEnum::INTERNAL_LINK,
                                    'href' => '/models/' . strtolower($m),
                                ],
                                'children' => [],
                            ],
                        )
                        ->toArray(),
                ],
                // Demo of custom template-based item (no direct link data)
                [
                    'label' => 'Подбор модели',
                    'data' => null,
                    'template' => [
                        'name' => 'NavigationCarSelectionDefaultTemplate',
                        'props' => [
                            'title' => 'Выберите модель TENET',
                            'items' => [
                                ['mark' => 'TENET', 'model' => 'T4', 'price' => 2000000],
                                ['mark' => 'TENET', 'model' => 'T5', 'price' => 2300000],
                                ['mark' => 'TENET', 'model' => 'T6', 'price' => 2600000],
                            ],
                        ],
                    ],
                    'children' => [],
                ],
                [
                    'label' => 'Автомобили в наличии',
                    'data' => null,
                    'children' => [
                        [
                            'label' => 'Новые',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/cars/new'],
                            'children' => [],
                        ],
                        [
                            'label' => 'С пробегом',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/cars/used'],
                            'children' => [],
                        ],
                    ],
                ],
                [
                    'label' => 'Спецпредложения',
                    'data' => null,
                    'children' => [
                        [
                            'label' => 'Покупка',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/offers/buy'],
                            'children' => [],
                        ],
                        [
                            'label' => 'Сервис',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/offers/service'],
                            'children' => [],
                        ],
                    ],
                ],
                [
                    'label' => 'Сервис и ТО',
                    'data' => null,
                    'children' => [
                        [
                            'label' => 'Запись на ТО',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/service/maintenance'],
                            'children' => [],
                        ],
                        [
                            'label' => 'Кузовной ремонт',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/service/body'],
                            'children' => [],
                        ],
                    ],
                ],
                [
                    'label' => 'О компании',
                    'data' => null,
                    'children' => [
                        [
                            'label' => 'История',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/about/history'],
                            'children' => [],
                        ],
                        [
                            'label' => 'Новости',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/about/news'],
                            'children' => [],
                        ],
                        [
                            'label' => 'Команда',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/about/team'],
                            'children' => [],
                        ],
                    ],
                ],
                [
                    'label' => 'Контакты',
                    'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/contacts'],
                    'children' => [],
                ],
            ],
            'footer' => [
                [
                    'label' => 'Политика',
                    'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/policy'],
                    'children' => [],
                ],
                [
                    'label' => 'Конфиденциальность',
                    'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/privacy'],
                    'children' => [],
                ],
                [
                    'label' => 'Правила сайта',
                    'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/terms'],
                    'children' => [],
                ],
            ],
        ][$handle] ?? [];
    }
}
