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
                // [
                //     'name' => 'CarSlider',
                //     'data' => [
                //         'tabs' => [
                //             [
                //                 'type' => 'new',
                //                 'label' => 'Новые',
                //                 'title' => 'Новые автомобили TENET в наличии',
                //                 'cta' => [
                //                     'label' => 'Все автомобили',
                //                     'url' => '#',
                //                 ],
                //                 'items' => collect(range(0, 8))->map(
                //                     fn($i) => [
                //                         'preview' =>
                //                             'https://www.avtogermes.ru/images/marks/tenet/t4/i/colors/st/tenet-t4-i-seryj-metallik.e981eeadf9d1beff37fd62ffd7d1bb40.png',
                //                         'type' => ['new', 'second'][rand(0, 1)],
                //                         'mark' => 'TENET',
                //                         'model' => 'T4',
                //                         'complectation' => 'Active',
                //                         'modification' =>
                //                             '2025 г., МКПП , 1.5 л (113 л.с), Бензиновый, Передний привод',
                //                         'color' => [
                //                             'name' => 'Темно-серый',
                //                             'hex' => '#4C4C51',
                //                         ],
                //                         'features' => ['в наличии', 'c ПТС'],
                //                         'price' => 2200000,
                //                         'benefit' => 700000,
                //                         'cta' => [
                //                             'label' => 'Получить предложение #' . $i,
                //                             'url' => '#',
                //                         ],
                //                         'secondCta' => [
                //                             'label' => 'Записаться на тест-драйв',
                //                             'url' => '#',
                //                         ],
                //                     ],
                //                 ),
                //             ],
                //             [
                //                 'type' => 'second',
                //                 'label' => 'С пробегом',
                //                 'title' => 'Автомобили TENET c пробегом в наличии',
                //                 'cta' => [
                //                     'label' => 'Все автомобили',
                //                     'url' => '#1',
                //                 ],
                //                 'items' => collect(range(0, 8))->map(
                //                     fn($i) => [
                //                         'preview' =>
                //                             'https://www.avtogermes.ru/images/second_cars/LVVDB21BXMD125020/chery-tiggo-7-pro-i.35e4f46b94157cb225f0dbbf9de88b82.jpg',
                //                         'type' => ['new', 'second'][rand(0, 1)],
                //                         'mark' => 'TENET',
                //                         'model' => 'T5',
                //                         'complectation' => 'Active',
                //                         'modification' =>
                //                             '2025 г., МКПП , 1.5 л (113 л.с), Бензиновый, Передний привод',
                //                         'color' => [
                //                             'name' => 'Красненький',
                //                             'hex' => '#e35b55',
                //                         ],
                //                         'price' => 2200000,
                //                         'benefit' => 100000,
                //                         'cta' => [
                //                             'label' => 'Получить предложение #' . $i,
                //                             'url' => '#',
                //                         ],
                //                         'secondCta' => [
                //                             'label' => 'Записаться на тест-драйв',
                //                             'url' => '#',
                //                         ],
                //                     ],
                //                 ),
                //             ],
                //         ],
                //     ],
                // ],

                // [
                //     'name' => 'AsideList',
                //     'data' => [
                //         'title' => 'Дополнительные услуги',
                //         'photo' =>
                //             'https://www.avtogermes.ru/images/promo/xl/tenet-t8-s-vygodoj-do-900-000.97a1abcfa43d2b3cc4002e50ea5632d6.jpg',
                //         'items' => [
                //             [
                //                 'title' => 'Услуга 1',
                //                 'description' => 'оборудование и материалы при обслуживании автомобилей',
                //                 'url' => '#',
                //             ],
                //             [
                //                 'title' => 'Услуга 2',
                //                 'description' =>
                //                     'оборудование и материалы при обслуживании автомобилей, оборудование и материалы при обслуживании автомобилей',
                //                 'url' => '#',
                //             ],
                //             [
                //                 'title' => 'Услуга 3',
                //                 'description' => 'оборудование и материалы при обслуживании автомобилей',
                //                 'url' => '#',
                //             ],
                //         ],
                //     ],
                // ],

                // [
                //     'name' => 'FeatureSlider',
                //     'data' => [
                //         'columns' => 4,
                //         'items' => [
                //             [
                //                 'icon' => 'ag:steering-wheel',
                //                 'title' => 'Запись на тест‑драйв',
                //                 'description' =>
                //                     'мы используем только высококачественное оборудование и материалы при обслуживании автомобилей',
                //                 'url' => '#',
                //             ],
                //             [
                //                 'icon' => 'ag:money',
                //                 'title' => 'Купить онлайн',
                //                 'description' =>
                //                     'мы используем только высококачественное оборудование и материалы при обслуживании автомобилей',
                //                 'url' => '#',
                //             ],
                //             [
                //                 'icon' => 'ag:service',
                //                 'title' => 'Запись на ТО',
                //                 'description' =>
                //                     'мы используем только высококачественное оборудование и материалы при обслуживании автомобилей',
                //                 'url' => '#',
                //             ],
                //             [
                //                 'icon' => 'ag:calc',
                //                 'title' => 'Запись на ТО',
                //                 'description' =>
                //                     'мы используем только высококачественное оборудование и материалы при обслуживании автомобилей',
                //                 'url' => '#',
                //             ],
                //         ],
                //     ],
                // ],
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
