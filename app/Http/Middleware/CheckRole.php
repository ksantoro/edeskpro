<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    public function handle($request, Closure $next)
    {
        if ($request->user() === null) {
            return response(view('oops'), 401);
        }

        if ($request->user()->type_user_id == 1) {
            return $next($request);
        }

        $actions = $request->route()->getAction();
        $roles   = [];

        foreach ($actions['middleware'] as $action) {
            if (strpos($action, 'roles') === false) {
                continue;
            }
            else {
                $match = explode(':', $action);
                $roles = explode(',', $match[1]);
                break;
            }
        }

        if ($request->user()->hasAnyRole($roles) || empty($roles)) {
            return $next($request);
        }

        return response(view('oops'), 401);
    }
}
