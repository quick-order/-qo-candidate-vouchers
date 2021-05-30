<?php

namespace App\Http\Middleware;

use App\Exceptions\TokenMismatchException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class AuthAPIToken
 * @package App\Http\Middleware
 */
class AuthAPIToken
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws TokenMismatchException
     */
    public function handle(Request $request, Closure $next)
    {
        $headerToken = $request->header(config('api.header'));
        $signature = hash_hmac('sha1', '', config('api.token'));
        if ($headerToken !== $signature) {
            throw new TokenMismatchException('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
