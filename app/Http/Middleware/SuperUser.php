<?php

namespace App\Http\Middleware;

use Closure;

class SuperUser
{
    public function handle($request, Closure $next)
    {
        if ($request->user() === null) {
            return response('Insufficient permissions', 401);
        }

        if ($request->user()->type_user_id == 1) {
            return $next($request);
        }

        return response('Insufficient permissions', 401);
    }
}
