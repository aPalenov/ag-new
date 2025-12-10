<?php

namespace App\Services\Tenant;

use Illuminate\Http\Request;

class TenantManager
{
    private ?string $current = null;

    public function resolve(Request $request): string
    {
        $host = $this->extractHost($request);
        $tenant = $this->detectTenant($host);
        $this->current = $tenant;
        return $tenant;
    }

    public function setCurrent(string $tenant): void
    {
        $this->current = $tenant;
    }

    public function current(): string
    {
        return $this->current ?? 'main';
    }

    public function extractHost(Request $request): string
    {
        $xfh = $request->headers->get('x-forwarded-host');
        if ($xfh) {
            return trim(explode(',', $xfh)[0]);
        }
        return $request->getHost();
    }

    public function detectTenant(string $host): string
    {
        if (str_contains($host, 'ag-new.loc')) {
            $parts = explode('.', $host);
            if (count($parts) === 2) {
                return 'main';
            }
            return $parts[0];
        }

        return 'main';
    }
}
