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
