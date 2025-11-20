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
                                    ['name' => 'Gray', 'code' => '#111'],
                                    ['name' => 'Gray 3', 'code' => '#333'],
                                    ['name' => 'Gray 5', 'code' => '#555'],
                                    ['name' => 'Gray 7', 'code' => '#777'],
                                    ['name' => 'Gray 9', 'code' => '#999'],
                                    ['name' => 'Gray B', 'code' => '#bbb'],
                                ],
                                'cta' => 'Подробнее',
                                'preview' =>
                                    'https://www.avtogermes.ru/images/marks/tenet/t4/i/colors/st/tenet-t4-i-seryj-metallik.e981eeadf9d1beff37fd62ffd7d1bb40.png',
                                'priceMin' => 2200000,
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
                        'cta' => 'Читать далее',
                    ],
                ],
                [
                    'name' => 'FeatureList',
                    'data' => [
                        'items' => [
                            ['icon' => 'sparkles', 'title' => 'Скорость', 'text' => 'Очень быстро'],
                            ['icon' => 'shield', 'title' => 'Надёжность', 'text' => 'Всегда доступно'],
                        ],
                    ],
                ],
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
