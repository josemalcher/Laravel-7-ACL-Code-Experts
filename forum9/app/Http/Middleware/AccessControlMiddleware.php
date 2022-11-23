<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class AccessControlMiddleware
{

    use AuthorizesRequests;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $ignoreResources = config('accescontrollist')['ignore.resources'];

        if (!in_array($request->route()->getName(), $ignoreResources)) {
            $this->authorize($request->route()->getName());
        }


        return $next($request);
    }
}
