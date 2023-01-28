<?php

namespace Modules\Infrastructure\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
USE Tymon\JWTAuth\Exceptions\TokenExpiredException;
class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => __('infrastructure::translate.InvalidToken')], Response::HTTP_FORBIDDEN);
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => $e->getMessage()], Response::HTTP_FORBIDDEN);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }

        return $next($request);
    }
}
