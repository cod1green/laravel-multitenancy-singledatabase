<?php

namespace App\Http\Middleware;

use App\Tenant\Services\TenantManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IdentifyTenant
{
    protected TenantManager $tenantManager;

    public function __construct(TenantManager $tenantManager)
    {
        $this->tenantManager = $tenantManager;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost();
        $pos = strpos($host, env('TENANT_DOMAIN'));

        if ($this->tenantManager->loadTenant($pos !== false ? substr($host, 0, $pos - 1) : $host, $pos !== false)) {
            return $next($request);
        }

        throw new NotFoundHttpException();
    }
}
