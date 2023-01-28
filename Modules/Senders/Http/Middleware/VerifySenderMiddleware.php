<?php

namespace Modules\Senders\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Senders\Entities\Sender;

class VerifySenderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = auth()->user();
            if (Sender::class != $user->morph_user_type) {
                return response()->json([
                    'message' => __('infrastructure::translate.Unauthenticated'),
                    Response::HTTP_UNAUTHORIZED
                ]);
            }

        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
                Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
        return $next($request);
    }
}
