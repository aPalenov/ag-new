<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    /**
     * Return page JSON based on tenant (host) + path.
     */
    public function show(Request $request, ?string $any = null): JsonResponse
    {
        // Prefer original browser host forwarded by Nuxt SSR, fallback to request host
        $xfh = $request->headers->get('x-forwarded-host');
        if ($xfh) {
            $host = trim(explode(',', $xfh)[0]);
        } else {
            $host = $request->getHost();
        }
        $path = '/' . ltrim($any ?? '', '/');
        if ($path === '//') {
            $path = '/';
        }

        $tenant = $this->detectTenant($host);

        $app = [
            'baseUrl' => $request->getSchemeAndHttpHost(),
            'tenant' => $tenant,
        ];

        // Simulated tenant/page registry
        $data = $this->getTenantPageData($tenant, $path);
        if (!$data) {
            return response()->json(
                [
                    'error' => 'Not Found',
                    'message' => 'Page not defined for tenant',
                ],
                Response::HTTP_NOT_FOUND,
            );
        }

        $payload = [
            'component' => 'Page',
            'props' => array_merge($data, [
                'app' => $app,
                'url' => $path,
                'theme' => 'theme-default',
            ]),
        ];

        return response()->json($payload);
    }

    // Theme is not included in API: layout decides visuals on the client side

    private function detectTenant(string $host): string
    {
        if (str_contains($host, 'ag-new.loc')) {
            $parts = explode('.', $host);
            if (count($parts) === 2) {
                return 'main';
            }
            return $parts[0]; // e.g. kia, lada
        }
        return 'main';
    }

    private function getTenantPageData(string $tenant, string $path): ?array
    {
        // Static seed data for demo. In real app fetch from DB / cache.
        $tenants = [
            'main' => [
                '/' => $this->pageHome('Main Site'),
                '/about' => $this->pageAbout('Main Site'),
            ],
            'kia' => [
                '/' => $this->pageHome('KIA Dealer'),
                '/service' => $this->pageService('KIA Dealer'),
            ],
            'tenet' => [
                '/' => $this->pageHome('Tenet Dealer'),
                '/service' => $this->pageService('Tenet Dealer'),
            ],
            'lada' => [
                '/' => $this->pageHome('LADA Center'),
                '/models' => $this->pageService('LADA Center'),
            ],
        ];

        return $tenants[$tenant][$path] ?? null;
    }

    private function baseStructure(string $siteName): array
    {
        return [
            'settings' => [
                'contact' => [
                    'phone' => ['link' => '88001234567', 'name' => '+7 (800) 123-45-67'],
                    'email' => 'info@example.test',
                    'address' => 'Some street 1',
                ],
            ],
            'navigation' => [
                'main' => [
                    ['label' => 'Главная', 'data' => ['type' => 'page', 'href' => '/'], 'children' => []],
                    ['label' => 'О нас', 'data' => ['type' => 'page', 'href' => '/about'], 'children' => []],
                ],
                'footer' => [
                    ['label' => 'Политика', 'data' => ['type' => 'page', 'href' => '/policy'], 'children' => []],
                ],
            ],
            'breadcrumbs' => [],
        ];
    }

    private function pageHome(string $siteName): array
    {
        return array_merge($this->baseStructure($siteName), [
            'meta' => ['title' => "Home – $siteName", 'description' => "$siteName description"],
            'pageBuilderData' => [
                [
                    'name' => 'HeroBanner',
                    'data' => ['title' => $siteName, 'subtitle' => 'Добро пожаловать', 'cta' => 'Подробнее'],
                ],
                [
                    'name' => 'ModelSlider',
                    'data' => [
                        'title' => 'Официальный дилер TENET в Москве',
                        'items' => collect(range(0, 5))->map(
                            fn($i) => [
                                'mark' => 'TENET',
                                'model' => 'T4',
                                'subtitle' => 'Семейный компактный кроссовер #' . $i,
                                'count' => rand(1, 10),
                                'colors' => [
                                    ['name' => 'Gray', 'hex' => '#111'],
                                    ['name' => 'Gray 3', 'hex' => '#333'],
                                    ['name' => 'Gray 5', 'hex' => '#555'],
                                    ['name' => 'Gray 7', 'hex' => '#777'],
                                    ['name' => 'Gray 9', 'hex' => '#999'],
                                    ['name' => 'Gray B', 'hex' => '#bbb'],
                                ],
                                'cta' => [
                                    'label' => 'Подробнее',
                                    'url' => '#',
                                ],
                                'preview' =>
                                    'https://www.avtogermes.ru/images/marks/tenet/t4/i/colors/st/tenet-t4-i-seryj-metallik.e981eeadf9d1beff37fd62ffd7d1bb40.png',
                                'price' => 2200000,
                                'benefit' => 2200000,
                            ],
                        ),
                    ],
                ],
                [
                    'name' => 'TextBlock',
                    'data' => [
                        'title' => 'Купить автомобили TENET в Москве',
                        'columns' => 2,
                        'text' => 'Во всех автосалонах «АвтоГЕРМЕС» каждому нашему клиенту гарантирован индивидуальный подход. С Вами будет общаться Ваш персональный менеджер, который будет лично контролировать процесс подготовки Вашего автомобиля до момента выезда автомобиля из салона. Покупая автомобиль у нас, Вы получаете персональную дисконтную карту, которая предоставляет скидки на обслуживание в техническом центре.<br><br>
                        Клиентом «АвтоГЕРМЕС» может стать и любая организация, независимо от ее величины и формы собственности. Для корпоративных клиентов мы предлагаем особые условия покупки и технического обслуживания автомобилей. «АвтоГЕРМЕС» сотрудничает со страховыми компаниями, представители которых находятся в нашем офисе. При покупке автомобиля Вы можете сразу оформить все необходимые документы и застраховать свой автомобиль в одной из 10 ведущих страховых компаний на лучших условиях!',
                        'cta' => [
                            'label' => 'Читать далее',
                            'url' => '#',
                        ],
                    ],
                ],
                [
                    'name' => 'OfferSlider',
                    'data' => [
                        'title' => 'Новости и спецпредложения',
                        'cta' => [
                            'label' => 'Все новости',
                            'url' => '#',
                        ],
                        'items' => collect(range(0, 5))->map(
                            fn($i) => [
                                'preview' =>
                                    'https://www.avtogermes.ru/images/promo/card/tenet-t4-s-vygodoj-do-878-000.f2267106231b9c0281bc8fbb7c1a7137.jpg',
                                'type' => ['news', 'offer'][rand(0, 1)],
                                'title' => 'Коробки передач: виды, преимущества',
                                'description' => [
                                    'Коробки передач: виды, преимущества и недостатки',
                                    'Коробки передач',
                                ][rand(0, 1)],
                                'publishedAt' => now(),
                                'cta' => [
                                    'label' => 'Подробнее',
                                    'url' => '#',
                                ],
                            ],
                        ),
                    ],
                ],
                [
                    'name' => 'VideoSlider',
                    'data' => [
                        'title' => 'Видеообзоры',
                        'cta' => [
                            'label' => 'Все видеобзоры',
                            'url' => '#',
                        ],
                        'items' => collect(range(0, 5))->map(
                            fn($i) => [
                                'preview' =>
                                    'https://www.avtogermes.ru/images/promo/card/tenet-t4-s-vygodoj-do-878-000.f2267106231b9c0281bc8fbb7c1a7137.jpg',
                                'title' => 'Коробки передач: виды, преимущества и недостатки',
                                'publishedAt' => now(),
                                'url' => '#',
                            ],
                        ),
                    ],
                ],
                [
                    'name' => 'FeatureList',
                    'data' => [
                        // 'title' => 'Преимущества компании АвтоГЕРМЕС',
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
                                'description' =>
                                    'наши сотрудники действительно разбираются в машинах и любят свое дело',
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
                    ],
                ],
                [
                    'name' => 'CarSlider',
                    'data' => [
                        'tabs' => [
                            [
                                'type' => 'new',
                                'label' => 'Новые',
                                'title' => 'Новые автомобили TENET в наличии',
                                'cta' => [
                                    'label' => 'Все автомобили',
                                    'url' => '#',
                                ],
                                'items' => collect(range(0, 8))->map(
                                    fn($i) => [
                                        'preview' =>
                                            'https://www.avtogermes.ru/images/marks/tenet/t4/i/colors/st/tenet-t4-i-seryj-metallik.e981eeadf9d1beff37fd62ffd7d1bb40.png',
                                        'type' => ['new', 'second'][rand(0, 1)],
                                        'mark' => 'TENET',
                                        'model' => 'T4',
                                        'complectation' => 'Active',
                                        'modification' =>
                                            '2025 г., МКПП , 1.5 л (113 л.с), Бензиновый, Передний привод',
                                        'color' => [
                                            'name' => 'Темно-серый',
                                            'hex' => '#4C4C51',
                                        ],
                                        'features' => ['в наличии', 'c ПТС'],
                                        'price' => 2200000,
                                        'benefit' => 700000,
                                        'cta' => [
                                            'label' => 'Получить предложение #' . $i,
                                            'url' => '#',
                                        ],
                                        'secondCta' => [
                                            'label' => 'Записаться на тест-драйв',
                                            'url' => '#',
                                        ],
                                    ],
                                ),
                            ],
                            [
                                'type' => 'second',
                                'label' => 'С пробегом',
                                'title' => 'Автомобили TENET c пробегом в наличии',
                                'cta' => [
                                    'label' => 'Все автомобили',
                                    'url' => '#1',
                                ],
                                'items' => collect(range(0, 8))->map(
                                    fn($i) => [
                                        'preview' =>
                                            'https://www.avtogermes.ru/images/second_cars/LVVDB21BXMD125020/chery-tiggo-7-pro-i.35e4f46b94157cb225f0dbbf9de88b82.jpg',
                                        'type' => ['new', 'second'][rand(0, 1)],
                                        'mark' => 'TENET',
                                        'model' => 'T5',
                                        'complectation' => 'Active',
                                        'modification' =>
                                            '2025 г., МКПП , 1.5 л (113 л.с), Бензиновый, Передний привод',
                                        'color' => [
                                            'name' => 'Красненький',
                                            'hex' => '#e35b55',
                                        ],
                                        'price' => 2200000,
                                        'benefit' => 100000,
                                        'cta' => [
                                            'label' => 'Получить предложение #' . $i,
                                            'url' => '#',
                                        ],
                                        'secondCta' => [
                                            'label' => 'Записаться на тест-драйв',
                                            'url' => '#',
                                        ],
                                    ],
                                ),
                            ],
                        ],
                    ],
                ],

                [
                    'name' => 'AsideList',
                    'data' => [
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
                    ],
                ],
                [
                    'name' => 'AsideList',
                    'data' => [
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
                    ],
                ],

                [
                    'name' => 'FeatureSlider',
                    'data' => [
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
                    ],
                ],
                [
                    'name' => 'MapBlock',
                    'data' => [
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
                    ],
                ],
                // [
                //     'name' => 'FeatureList',
                //     'data' => [
                //         'items' => [
                //             ['icon' => 'sparkles', 'title' => 'Скорость', 'text' => 'Очень быстро'],
                //             ['icon' => 'shield', 'title' => 'Надёжность', 'text' => 'Всегда доступно'],
                //         ],
                //     ],
                // ],
            ],
        ]);
    }

    private function pageAbout(string $siteName): array
    {
        return array_merge($this->baseStructure($siteName), [
            'meta' => ['title' => "About – $siteName", 'description' => 'О компании'],
            'pageBuilderData' => [['name' => 'TextBlock', 'data' => ['text' => 'Мы делаем классные вещи.']]],
        ]);
    }

    private function pageService(string $siteName): array
    {
        return array_merge($this->baseStructure($siteName), [
            'meta' => ['title' => "Services – $siteName", 'description' => 'Наши услуги'],
            'pageBuilderData' => [
                [
                    'name' => 'ServiceGrid',
                    'data' => ['services' => [['title' => 'Диагностика'], ['title' => 'ТО'], ['title' => 'Ремонт']]],
                ],
            ],
        ]);
    }
}
