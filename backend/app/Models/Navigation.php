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
                    'label' => 'Модельный ряд',
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
                // Demo of custom template-based item (no direct link data)
                [
                    'label' => 'Автомобили в наличии',
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
                [
                    'label' => 'Спецпредложения',
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
                    'name' => 'models',
                    'label' => 'Модели',
                    'children' => [
                        [
                            'label' => 'TENET T4',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/models/t4'],
                            'children' => [],
                        ],
                        [
                            'label' => 'TENET T4',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/models/t4'],
                            'children' => [],
                        ],
                        [
                            'label' => 'TENET T4',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/models/t4'],
                            'children' => [],
                        ],
                    ],
                ],
                [
                    'label' => 'Покупателям',
                    'children' => [
                        [
                            'label' => 'Автомобили в наличии',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/cars'],
                            'children' => [],
                        ],
                        [
                            'label' => 'Лизинг',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/leasing'],
                            'children' => [],
                        ],
                        [
                            'label' => 'Кредит',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/credit'],
                            'children' => [],
                        ],
                    ],
                ],
                [
                    'label' => 'Владельцам',
                    'children' => [
                        [
                            'label' => 'Запись на ТО',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/service/maintenance'],
                            'children' => [],
                        ],
                        [
                            'label' => 'Гарантийное обслуживание',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/service/warranty'],
                            'children' => [],
                        ],
                    ],
                ],
                [
                    'label' => 'О нас',
                    'children' => [
                        [
                            'label' => 'О компании',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/about'],
                            'children' => [],
                        ],
                        [
                            'name' => 'contacts',
                            'label' => 'Контакты',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/contacts'],
                            'children' => [],
                        ],
                        [
                            'label' => 'Новости',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/news'],
                            'children' => [],
                        ],
                        [
                            'label' => 'Видеообзоры',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/videos'],
                            'children' => [],
                        ],
                        [
                            'label' => 'О бренде',
                            'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/brand'],
                            'children' => [],
                        ],
                    ],
                ],
                [
                    'label' => 'Контакты',
                    'name' => 'contacts',
                    'data' => ['type' => LinkTypeEnum::INTERNAL_LINK, 'href' => '/contacts'],
                    'children' => [],
                ],
            ],
        ][$handle] ?? [];
    }
}
