<?php

namespace App\Http\Middleware;

use App\Exceptions\PermissionDeniedException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class CheckRole
 * @package App\Http\Middleware
 */
class CheckRole
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param ...$abilities
     * @return mixed
     * @throws PermissionDeniedException
     */
    public function handle(Request $request, Closure $next, ...$abilities)
    {
        foreach ($abilities as $ability) {
            if (!$request->user()->tokenCan($ability)) {
                throw new PermissionDeniedException('No permission', Response::HTTP_FORBIDDEN);
            }
        }

        return $next($request);
    }
}
