<?php

namespace App\Http\Middleware;

use App\Data\Navigation\NavigationData;
use App\Data\Shared\SharedData;
use App\Models\Navigation;
use App\Services\Breadcrumb\BreadcrumbManager;
use App\Services\Seo\MetaManager;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HandleApiSharedPageData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (!$response instanceof JsonResponse || !$response->isSuccessful()) {
            return $response;
        }

        $data = SharedData::from([
            'app' => [
                'baseUrl' => url('/'),
                'serverTime' => now()->toIso8601String(),
                'tenant' => config('app.tenant'),
            ],
            'settings' => [
                'contact' => config('settings.general.contact'), // TODO: make dynamic
            ],
            'navigation' => NavigationData::from(Navigation::getTreesByHandles(['main', 'footer'])),
            'meta' => app(MetaManager::class)->toData(),
            'breadcrumbs' => app(BreadcrumbManager::class)->toData(),
            'theme' => 'theme-default', // TODO: make dynamic
            'page' => $response->getData(true),
        ])->toArray();

        $response->setData($data);

        return $response;
    }
}
