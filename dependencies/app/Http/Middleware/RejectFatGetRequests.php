<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RejectFatGetRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check GET request and have body
        if ($request->isMethod('GET') && !empty($request->getContent())) {
            return response()->json([
                'error' => 'GET requests must not have a body'
            ], 400);
        }

        return $next($request);
    }
}
