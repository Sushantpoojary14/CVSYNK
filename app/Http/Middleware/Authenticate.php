<?php

namespace App\Http\Middleware;

;

use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\BaseMiddleware;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends BaseMiddleware
{

    public function handle(Request $request, \Closure $next): Response
    {

        $token= request()->bearerToken();
        if(!$token){
            return response()->json(['error' => 'Unauthorized or token invalid'], 401);
        }
        $token = request()->bearerToken();


        $tokenParts = explode('.', $token);

        $payload = json_decode(base64_decode($tokenParts[1]), true);

        if (isset($payload['exp'])) {

            $expirationTime = $payload['exp'];

            $currentTime = time();

            if ($currentTime >= $expirationTime) {
                return response()->json(['error' => 'Token has expired'], 401);
            }
        }
        try {
            JWTAuth::parseToken()->getToken('');

        } catch (TokenExpiredException $e) {

        } catch (JWTException $e) {
            return response()->json(['error' => 'Unauthorized or token invalid'], 401);
        }

        return $next($request);

    }
}
