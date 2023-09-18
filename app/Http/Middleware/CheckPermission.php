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
        $boll        = false;
        $identifiers = explode('|', $permissionIdentifier);

        /** If user has at least one permission it will be approved  */
        foreach ($identifiers as $identifier) {
            if ($request->user()->can($identifier)) {
                $boll = true;
            }
        }

        abort_unless(
            $boll,
            Response::HTTP_FORBIDDEN
        );

        return $next($request);
    }
}
