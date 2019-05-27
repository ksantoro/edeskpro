<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    public function handle($request, Closure $next)
    {
        if ($request->user() === null) {
            return response('Insufficient permissions', 401);
        }

        if ($request->user()->type_user_id == 1) {
            return $next($request);
        }

        $actions = $request->route()->getAction();
        $roles   = isset($actions['roles']) ? $actions['roles'] : null;

        if ($request->user()->hasAnyRole($roles) || ! $roles) {
            return $next($request);
        }

        return response('Insufficient permissions', 401);
    }
}
