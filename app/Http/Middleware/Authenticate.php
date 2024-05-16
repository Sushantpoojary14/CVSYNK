<?php

namespace App\Http\Middleware;

;

use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\BaseMiddleware;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends BaseMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, \Closure $next): Response
    {



        try {
            JWTAuth::parseToken()->getToken();

        } catch (JWTException $e) {
            return response()->json(['error' => 'unAuthorized or token expired'], 401);
        }

        return $next($request);

    }
}
