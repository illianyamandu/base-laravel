<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return Response|Closure
     */
    public function handle(Request $request, Closure $next, string $permissionIdentifier)
    {
        abort_unless(
            $request->user()->can($permissionIdentifier),
            Response::HTTP_FORBIDDEN
        );

        return $next($request);
    }
}
